<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class IndexController extends BaseController
{
    public function index(){
        return view('index');
    }
    
    /**
     * Graphのトークン取得
     *
     * @return void
     */
    public function graphtoken(){
        $apptoken = request()->get('apptoken');
        
        // ホントはここで検証を行う

        // Graphのアクセストークンを代理フローで取得
        // https://docs.microsoft.com/ja-jp/azure/active-directory/develop/v2-oauth2-on-behalf-of-flow
        $client = new \GuzzleHttp\Client;

        $res = $client->request(
            'POST',
            'https://login.microsoftonline.com/common/oauth2/v2.0/token',
            [
                'form_params' => [
                    'grant_type' => 'urn:ietf:params:oauth:grant-type:jwt-bearer',
                    'client_id' => env('CLIENT_ID'),
                    'client_secret' => env('CLIENT_SECRET'),
                    'assertion' => $apptoken,
                    'scope' => env('SCOPE'),
                    'requested_token_use' => 'on_behalf_of',
                ]
            ]
        );

        $list = json_decode($res->getBody()->getContents(), true);
        return $list;
    }
}   
