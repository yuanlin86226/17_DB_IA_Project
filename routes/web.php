<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/','AuthController@index');
Route::get('/login','AuthController@index');
Route::post('/login','AuthController@login');

Route::get('/admin/logout','AuthController@logout');


Route::get('/admin/user','Admin\UserController@index');
Route::get('/admin/role','Admin\RoleController@index');
Route::get('/admin/menu','Admin\MenuController@index');

Route::get('/admin/company','Admin\CompanyController@index');


Route::get('/admin/employee', function () {
    return view('/admin/code');
});
Route::get('/admin/customer', function () {
    return view('/admin/code');
});
Route::get('/admin/supplier', function () {
    return view('/admin/code');
});
Route::get('/admin/productType', function () {
    return view('/admin/code');
});
Route::get('/admin/productData', function () {
    return view('/admin/code');
});