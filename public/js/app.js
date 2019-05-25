
function log(text){
    var $log = $('#log');

    $log.html($log.html() + '<br/><br/><br/>' + text);
}

/**
 * Microsoft Graphのトークンをサーバーサイドから取得
 * @param string apptoken アドイントークン
 */
function getGraphToken(apptoken){
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    
    $.ajax({
        url:'./graphtoken',
        type:'POST',
        data:{
            'apptoken':apptoken,
            '_token' : CSRF_TOKEN,
        }
    })
    // Ajaxリクエストが成功した時発動
    .done(function(data){
        $('#graph_token').val(data.access_token);
        $('#graph_refresh_token').val(data.refresh_token);
    })
    // Ajaxリクエストが失敗した時発動
    .fail(function(data){
        log('Graph token error : ' + JSON.stringify(data));
    })
    // Ajaxリクエストが成功・失敗どちらでも発動
    .always(function(data){
    });
}

(function(){
    // 初期化処理
    Office.onReady(function(info) {
        if(!Office.context.auth.getAccessTokenAsync){
            log('Office.context.auth.getAccessTokenAsync not supported');
            return;
        }

        // 認証実行
        Office.context.auth.getAccessTokenAsync(function (result) {
            if (result.status === "succeeded") {
                // Use this token to call Web API
                var ssoToken = result.value;
                $('#addin_token').val(ssoToken);

                // decode user info
                var decoded = jwt_decode(ssoToken);

                $('#username').val(decoded.name);
                $('#email').val(decoded.preferred_username);

                getGraphToken(ssoToken);
            } else {
                if (result.error.code === 13003) {
                    // SSO is not supported for domain user accounts, only
                    // work or school (Office 365) or Microsoft Account IDs.
                } else {
                    // Handle error
                }
                
                log('error ' + result.error.code);
            }
        });
    });
})();
