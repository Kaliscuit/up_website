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

    Route::post('position/search', function()
    {
        $keyword = Input::get('keyword', '');
        $result = [];
        $result[] = ['name' => $keyword . '工程师', 'desc' => $keyword . '工程师'];
        $result[] = ['name' => $keyword . '设计师', 'desc' => $keyword . '设计师'];
        $result[] = ['name' => $keyword . '设计工程师', 'desc' => $keyword . '设计工程师'];
        $result[] = ['name' => $keyword . '工程设计工程师', 'desc' => $keyword . '工程设计工程师'];
        $result[] = ['name' => $keyword . '设计工程设计工程师', 'desc' => $keyword . '设计工程设计工程师'];
        $result[] = ['name' => $keyword . '工程设计工程设计工程师', 'desc' => $keyword . '工程设计工程设计工程师'];
        $result[] = ['name' => $keyword . '设计工程设计工程设计工程师', 'desc' => $keyword . '设计工程设计工程设计工程师'];
        $result[] = ['name' => $keyword . '工程设计工程设计工程设计工程师', 'desc' => $keyword . '工程设计工程设计工程设计工程师'];
        $result[] = ['name' => $keyword . '设计工程设计工程设计工程设计工程师', 'desc' => $keyword . '设计工程设计工程设计工程设计工程师'];
        $result[] = ['name' => $keyword . '工程设计工程设计工程设计工程设计工程师', 'desc' => $keyword . '工程设计工程设计工程设计工程设计工程师'];
        $result[] = ['name' => $keyword . '设计工程设计工程设计工程设计工程设计工程师', 'desc' => $keyword . '设计工程设计工程设计工程设计工程设计工程师'];
        $result[] = ['name' => $keyword . '工程设计工程设计工程设计工程设计工程设计工程师', 'desc' => $keyword . '工程设计工程设计工程设计工程设计工程设计工程师'];
        $result[] = ['name' => $keyword . '设计工程设计工程设计工程设计工程设计工程设计工程师', 'desc' => $keyword . '设计工程设计工程设计工程设计工程设计工程设计工程师'];
        $result[] = ['name' => $keyword . '工程设计工程设计工程设计工程设计工程设计工程设计工程师', 'desc' => $keyword . '工程设计工程设计工程设计工程设计工程设计工程设计工程师'];
        $result[] = ['name' => $keyword . '设计工程设计工程设计工程设计工程设计工程设计工程设计工程师', 'desc' => $keyword . '设计工程设计工程设计工程设计工程设计工程设计工程设计工程师'];
        $result[] = ['name' => $keyword . '工程设计工程设计工程设计工程设计工程设计工程设计工程设计工程师', 'desc' => $keyword . '工程设计工程设计工程设计工程设计工程设计工程设计工程设计工程师'];

        return Response::json(array('c' => 200, 'm' => 'ok', 'd' => $result));
    });

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