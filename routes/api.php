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

Route::post('login','Api\AuthController@login');
Route::post('register','Api\AuthController@register');
Route::get('logout','Api\AuthController@logout');


//compra
Route::post('compras/create','Api\ComprasController@create')->middleware('jwtAuth');
Route::post('compras/delete','Api\ComprasController@delete')->middleware('jwtAuth');
Route::post('compras/update','Api\ComprasController@update')->middleware('jwtAuth');
Route::get('compras','Api\ComprasController@compras')->middleware('jwtAuth');
