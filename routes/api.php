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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('rest/register', 'RestaurantController@register');
Route::post('rest/login', 'RestaurantController@authenticate');
Route::post('user/login', 'UserController@authenticate');
Route::post('admin/login', 'AdminController@authenticate');


Route::group(['middleware' => ['jwt.verify:user']], function () {
    Route::get('user/user', 'UserController@getAuthenticatedUser');
    Route::get('user/logout', 'UserController@logout');
});

Route::group(['middleware' => ['jwt.verify:restaurants']], function () {
    Route::get('rest/user', 'RestaurantController@getAuthenticatedUser');
    Route::get('rest/logout', 'UserController@logout');

});

Route::get('refresh', 'UserController@refresh');


