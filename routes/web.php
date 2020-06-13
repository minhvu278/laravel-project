<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'AdminController@showDashboard');
Route::get('/logout', 'AdminController@logout');
Route::post('/admin-dashboard', 'AdminController@dashboard');

//Category
Route::get('/add-category', 'CategoryController@addCategory');
Route::get('/edit-category/{id}', 'CategoryController@editCategory');
Route::get('/delete-category/{id}', 'CategoryController@deleteCategory');
Route::get('/all-category', 'CategoryController@allCategory');
Route::post('/save-category', 'CategoryController@saveCategory');
Route::post('/update-category/{id}', 'CategoryController@updateCategory');
Route::get('/active-category/{id}', 'CategoryController@active');
Route::get('/inactive-category/{id}', 'CategoryController@inactive');

//Brand
Route::get('/add-brand', 'BrandController@addBrand');
Route::get('/edit-brand/{id}', 'BrandController@editBrand');
Route::get('/delete-brand/{id}', 'BrandController@deleteBrand');
Route::get('/all-brand', 'BrandController@allBrand');
Route::post('/save-brand', 'BrandController@saveBrand');
Route::post('/update-brand/{id}', 'BrandController@updateBrand');
Route::get('/active-brand/{id}', 'BrandController@active');
Route::get('/inactive-brand/{id}', 'BrandController@inactive');

//Product
Route::get('/add-product', 'ProductController@addProduct');
Route::get('/edit-product/{id}', 'ProductController@editProduct');
Route::get('/delete-product/{id}', 'ProductController@deleteProduct');
Route::get('/all-product', 'ProductController@allProduct');
Route::post('/save-product', 'ProductController@saveProduct');
Route::post('/update-product/{id}', 'ProductController@updateProduct');
Route::get('/active-product/{id}', 'ProductController@active');
Route::get('/inactive-product/{id}', 'ProductController@inactive');
