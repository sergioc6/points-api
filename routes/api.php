<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix' => 'points'], function () {
    Route::get('/', 'PointsController@index');
    Route::get('/{id}', 'PointsController@show')->where('id', '[0-9]+');
    Route::post('/', 'PointsController@create');
    Route::put('/{id}', 'PointsController@edit')->where('id', '[0-9]+');
    Route::delete('/{id}', 'PointsController@destroy')->where('id', '[0-9]+');
    Route::get('/{id}/nearby', 'PointsController@getNearbyPoints')->where('id', '[0-9]+');
});
