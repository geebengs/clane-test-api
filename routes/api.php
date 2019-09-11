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

Route::group(['middleware' => 'api', 'prefix' => 'v1/auth'], function ($router) {
    Route::post('login', 'Api\AuthController@login');
    Route::post('logout', 'Api\AuthController@logout');
    Route::post('refresh', 'Api\AuthController@refresh');
    Route::post('me', 'Api\AuthController@me');

});

Route::group(['prefix' => 'v1'], function() {
    Route::resource('articles', 'Api\ArticleApiController');
    Route::post('articles/{id}/rating', 'Api\ArticleApiController@rating');

});

Route::group(['prefix' => 'v1'], function() {
    Route::resource('users', 'Api\UserApiController');
});