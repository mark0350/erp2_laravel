<?php

use Illuminate\Http\Request;

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

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('/digital', 'DigitalController@create')->middleware('api.auth:api','isAdmin');
Route::post('/analog', 'AnalogController@create')->middleware('api.auth:api','isAdmin');
Route::post('/production', 'ProductionController@create')->middleware('api.auth:api','isAdmin');
Route::post('/wechat', 'WechatController@response');