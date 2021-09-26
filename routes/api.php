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

Route::get('/create_dummy_admin', 'ByPassController@create');
Route::post('/auth/login', 'ByPassController@store');
Route::post('add_chart', 'HomeController@store')->name('add_chart');
Route::get('/auth/check', 'ByPassController@check_auth');

Route::group(['prefix' => 'v1'], function () {
	Route::get('get_province', 'ByPassController@get_province')->name('get_province');
	Route::get('get_city', 'ByPassController@get_city')->name('get_city');
	Route::get('get_subdistrict', 'ByPassController@get_subdistrict')->name('get_subdistrict');
	Route::get('get_cost', 'ByPassController@get_cost')->name('get_cost');
});
