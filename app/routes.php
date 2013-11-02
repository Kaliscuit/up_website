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

Route::group(array('domain' => 'api.local.v2up.me'), function()
{

    Route::get('user', function()
    {
        return 'api local user';
    });

});

Route::group(array('domain' => 'api.dev.v2up.me'), function()
{

    Route::get('user', function()
    {
        return 'api dev user';
    });

});

Route::group(array('domain' => 'local.v2up.me'), function()
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

Route::group(array('domain' => 'dev.v2up.me'), function()
{

    Route::get('/', function()
    {
        return View::make('hello');
    });

    Route::get('user', function()
    {
        return  'dev user';
    });

});
