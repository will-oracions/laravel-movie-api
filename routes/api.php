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

Route::get('movies', 'MovieApiController@index');
Route::get('movies/{id}', 'MovieApiController@show');
Route::post('movies', 'MovieApiController@store');
Route::post('movies/{id}', 'MovieApiController@update');
Route::get('movies/delete/{id}', 'MovieApiController@delete');
