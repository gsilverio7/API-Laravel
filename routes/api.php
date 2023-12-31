<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect ('api/documentation');
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('login', 'App\Http\Controllers\AuthController@login');
    Route::post('logout', 'App\Http\Controllers\AuthController@logout');
    Route::post('refresh', 'App\Http\Controllers\AuthController@refresh');
    Route::post('me', 'App\Http\Controllers\AuthController@me');
});

Route::group([
    'middleware' => 'api'
], function ($router) {
    Route::get('get/{id}', 'App\Http\Controllers\PersonController@get')
        ->where('id', '[0-9]+');
    Route::get('getAll', 'App\Http\Controllers\PersonController@getAll');
    Route::post('create', 'App\Http\Controllers\PersonController@create');
    Route::put('update', 'App\Http\Controllers\PersonController@update');
    Route::delete('delete', 'App\Http\Controllers\PersonController@delete');
});