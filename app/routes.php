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

$env = 'development';

switch ($env) {
    case 'product':
        $host = '';
        break;
    case 'testing':
        $host = 'dev.';
        break;
    case 'development':
        $host = 'local.';
        break;
    default:
        $host = '';
}


Route::group(array('domain' => 'api.' . $host .'v2up.me'), function()
{

    Route::any('/', function()
    {
        return Response::json(array('c' => 200, 'm' => 'ok'));
    });

    Route::any('position/suggest', 'PositionController@suggestPosition');
    Route::any('position/search', 'PositionController@searchPosition');
    Route::any('user/check', 'UserController@checkEmail');

});

Route::group(array('domain' => $host . 'v2up.me'), function()
{

    Route::get('/', function()
    {
        return View::make('hello');
    });

    Route::get('user', function()
    {
        return  'local user';
    });

    Route::get('github', function()
    {
        $client = new Github\Client();
        $repositories = $client->api('user')->repositories('Sunnykale');
        return Response::json($repositories);
        $client->authenticate('a4269e446086e3571436', 'b1f69b87ec27c1a3810a2ede96b7c27a8716e182', Github\Client::AUTH_URL_CLIENT_ID);
        $client->api('login');
    });

});