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

$env = 'testing';

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

});