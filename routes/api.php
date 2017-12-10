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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('api')->get('/admin/user', 'Admin\UserController@findAll');
Route::middleware('api')->post('/admin/user', 'Admin\UserController@save');
Route::middleware('api')->get('/admin/user/{id}', 'Admin\UserController@findOne');
Route::middleware('api')->put('/admin/user/{id}', 'Admin\UserController@update');
Route::middleware('api')->delete('/admin/user/{id}', 'Admin\UserController@destroy');
Route::middleware('api')->delete('/admin/user', 'Admin\UserController@destroyMany');
Route::middleware('api')->get('/admin/user/{id}/roles/{menu_id}', 'Admin\UserController@getRoles');


Route::middleware('api')->get('/admin/menu_list/{user_id}', 'Admin\MenuController@menu_list');
