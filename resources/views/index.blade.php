<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <title>Office.js SSO</title>

<style>
    body{
        width:100%;
    }

    *{
        word-wrap: break-word;
    }

    .form_item{
        margin-top:1em;
    }

    .form_value{
        width:90%;
    }
</style>
        <script
            src="https://code.jquery.com/jquery-3.4.1.js"
            integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU="
            crossorigin="anonymous"></script>
        <script src="https://appsforoffice.microsoft.com/lib/beta/hosted/office.js"></script>
        <script src="js/jwt-decode.min.js"></script>
    </head>
    <body>
        SSO検証
        
        <div class="form_item">
            <label>アドイントークン</label>
            <input type="text" id="addin_token" class="form_value" />
        </div>
        
        <div class="form_item">
            <label>ユーザー名</label>
            <input type="text" id="username" class="form_value" />
        </div>

        <div class="form_item">
            <label>Eメール</label>
            <input type="text" id="email" class="form_value" />
        </div>

        <div class="form_item">
            <label>Graphアクセストークン</label>
            <input type="text" id="graph_token" class="form_value" />
        </div>

        <div class="form_item">
            <label>Graphリフレッシュトークン</label>
            <input type="text" id="graph_refresh_token" class="form_value" />
        </div>

        <div id="log"></div>
        <script src="js/app.js"></script>
    </body>
</html>
