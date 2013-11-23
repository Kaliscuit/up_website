<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

$env = 'dev';

switch ($env) {
    case 'product':
        $host = '';
        $GLOBALS['github_client_id'] = 'a4269e446086e3571436';
        $GLOBALS['github_client_secret'] = 'b1f69b87ec27c1a3810a2ede96b7c27a8716e182';
        break;
    case 'dev':
        $host = 'dev.';
        $GLOBALS['github_client_id'] = '9bde4b321fcf41dda148';
        $GLOBALS['github_client_secret'] = '54a9ccb474ccf7b983636c809ebb4aa08b38b616';
        break;
    case 'local':
        $GLOBALS['github_client_id'] = 'ada764725e1bfefc2f87';
        $GLOBALS['github_client_secret'] = '316f6a2386178054a157499006957138ab130124';
        $host = 'local.';
        break;
    default:
        $host = '';
}


Route::group(array('domain' => 'api.' . $host . 'v2up.me'), function () {

    Route::any('/', function () {
        return Response::json(array('c' => 200, 'm' => 'OK'));
    });

    Route::controller('user', 'UserController');
    Route::controller('position', 'PositionController');

});





Route::group(array('domain' => $host . 'v2up.me'), function () {

    Route::get('/', function () {
        return View::make('index');
    });

    Route::get('user/login', function () {
        return View::make('user/login');
    });

    Route::get('github', function () {
        return Redirect::to('https://github.com/login/oauth/authorize?client_id=' . $GLOBALS['github_client_id'] . '&scope=user,public_repo,gist');
        $client       = new Github\Client();
        $repositories = $client->api('user')->repositories('Sunnykale');
//        return Response::json($repositories);
        $client->authenticate($GLOBALS['github_client_id'], $GLOBALS['github_client_secret'], Github\Client::AUTH_URL_CLIENT_ID);
        $client->api('login');
    });

    Route::get('callback/github', function () {
        $code = Input::get('code', '');
        if ($code) {
            $params = [
                'client_id'     => $GLOBALS['github_client_id'],
                'client_secret' => $GLOBALS['github_client_secret'],
                'code'          => $code
            ];
            $return = CurlHelper::postUrl('https://github.com/login/oauth/access_token', $params);
            return Response::json($return);
        }
    });

});