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

Route::middleware('api')->get('/admin/menu_list/{user_id}', 'Admin\MenuController@menu_list');

Route::middleware('api')->get('/admin/user', 'Admin\UserController@findAll');
Route::middleware('api')->post('/admin/user', 'Admin\UserController@save');
Route::middleware('api')->get('/admin/user/{id}', 'Admin\UserController@findOne');
Route::middleware('api')->put('/admin/user/{id}', 'Admin\UserController@update');
Route::middleware('api')->delete('/admin/user/{id}', 'Admin\UserController@destroy');
Route::middleware('api')->delete('/admin/user', 'Admin\UserController@destroyMany');


Route::middleware('api')->get('/admin/user/{id}/roles', 'Admin\UserController@getRoles');
Route::middleware('api')->get('/admin/user/{id}/roles/{menu_id}', 'Admin\UserController@getSign');


Route::middleware('api')->get('/admin/role', 'Admin\RoleController@findAll');
Route::middleware('api')->post('/admin/role', 'Admin\RoleController@save');
Route::middleware('api')->get('/admin/role/{id}', 'Admin\RoleController@findOne');
Route::middleware('api')->put('/admin/role/{id}', 'Admin\RoleController@update');
Route::middleware('api')->delete('/admin/role/{id}', 'Admin\RoleController@destroy');
Route::middleware('api')->delete('/admin/role', 'Admin\RoleController@destroyMany');
Route::middleware('api')->get('/admin/role/{id}/menu_detail/{menu_id}', 'Admin\RoleController@findOneMenuDetail');


Route::middleware('api')->get('/admin/menu', 'Admin\MenuController@findAll');
Route::middleware('api')->get('/admin/menu/{id}', 'Admin\MenuController@findOne');
Route::middleware('api')->post('/admin/menu', 'Admin\MenuController@save');
Route::middleware('api')->put('/admin/menu/{id}', 'Admin\MenuController@update');
Route::middleware('api')->delete('/admin/menu/{id}', 'Admin\MenuController@destroy');
Route::middleware('api')->delete('/admin/menu', 'Admin\MenuController@destroyMany');


Route::middleware('api')->get('/admin/company', 'Admin\CompanyController@findOne');
Route::middleware('api')->put('/admin/company', 'Admin\CompanyController@update');


Route::middleware('api')->get('/admin/employee', 'Admin\EmployeeController@findAll');
Route::middleware('api')->get('/admin/employee/{id}', 'Admin\EmployeeController@findOne');
Route::middleware('api')->post('/admin/employee', 'Admin\EmployeeController@save');
Route::middleware('api')->put('/admin/employee/{id}', 'Admin\EmployeeController@update');
Route::middleware('api')->delete('/admin/employee/{id}', 'Admin\EmployeeController@destroy');
Route::middleware('api')->delete('/admin/employee', 'Admin\EmployeeController@destroyMany');


Route::middleware('api')->get('/admin/customer', 'Admin\CustomerController@findAll');
Route::middleware('api')->get('/admin/customer/{id}', 'Admin\CustomerController@findOne');
Route::middleware('api')->post('/admin/customer', 'Admin\CustomerController@save');
Route::middleware('api')->put('/admin/customer/{id}', 'Admin\CustomerController@update');
Route::middleware('api')->delete('/admin/customer/{id}', 'Admin\CustomerController@destroy');
Route::middleware('api')->delete('/admin/customer', 'Admin\CustomerController@destroyMany');
Route::middleware('api')->get('/admin/customer/{id}/orders', 'Admin\CustomerController@getOrders');

Route::middleware('api')->get('/admin/supplier', 'Admin\SupplierController@findAll');
Route::middleware('api')->get('/admin/supplier/{id}', 'Admin\SupplierController@findOne');
Route::middleware('api')->post('/admin/supplier', 'Admin\SupplierController@save');
Route::middleware('api')->put('/admin/supplier/{id}', 'Admin\SupplierController@update');
Route::middleware('api')->delete('/admin/supplier/{id}', 'Admin\SupplierController@destroy');
Route::middleware('api')->delete('/admin/supplier', 'Admin\SupplierController@destroyMany');

Route::middleware('api')->get('/admin/productType', 'Admin\ProductTypeController@findAll');
Route::middleware('api')->get('/admin/productType/{id}', 'Admin\ProductTypeController@findOne');
Route::middleware('api')->post('/admin/productType', 'Admin\ProductTypeController@save');
Route::middleware('api')->put('/admin/productType/{id}', 'Admin\ProductTypeController@update');
Route::middleware('api')->delete('/admin/productType/{id}', 'Admin\ProductTypeController@destroy');
Route::middleware('api')->delete('/admin/productType', 'Admin\ProductTypeController@destroyMany');

Route::middleware('api')->get('/admin/productData', 'Admin\ProductDataController@findAll');
Route::middleware('api')->get('/admin/productData/{id}', 'Admin\ProductDataController@findOne');
Route::middleware('api')->post('/admin/productData', 'Admin\ProductDataController@save');
Route::middleware('api')->put('/admin/productData/{id}', 'Admin\ProductDataController@update');
Route::middleware('api')->delete('/admin/productData/{id}', 'Admin\ProductDataController@destroy');
Route::middleware('api')->delete('/admin/productData', 'Admin\ProductDataController@destroyMany');
Route::middleware('api')->post('/admin/productData/upload', 'FileController@upload');