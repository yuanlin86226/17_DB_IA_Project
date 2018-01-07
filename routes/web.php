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
Route::get('/admin/employee','Admin\EmployeeController@index');
Route::get('/admin/customer','Admin\CustomerController@index');
Route::get('/admin/supplier','Admin\SupplierController@index');
Route::get('/admin/productType','Admin\ProductTypeController@index');
Route::get('/admin/productData','Admin\ProductDataController@index');

Route::get('/admin/purchase','Admin\PurchaseController@index');
Route::get('/admin/returnPurchase','Admin\ReturnPurchaseController@index');


// Route::get('/admin/', function () {
//     return view('/admin/code');
// });
