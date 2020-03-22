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

Route::get('/', 'Front\HomeController@_index'); //http://localhost/Fauna-Ideas/public


Route::namespace('Admin')->prefix('admin')->group(function () {
	setlocale(LC_ALL, "es_PE");

	Route::namespace('Auth')->group(function () {
		//Login
		Route::get('login', 'LoginController@form')->name('admin.login'); // http://localhost/Fauna-Ideas/public/admin/login
		Route::post('login', 'LoginController@login');
		Route::get('logout', 'LoginController@destroy')->name('admin.logout');
	});

	//Dashboard
	Route::namespace('Dashboard')->prefix('dashboard')->group(function () {
		Route::get('/', 'DashboardController@index')->name('admin.dashboard.index');
	});

	//Products
	Route::namespace('Product')->prefix('product')->group(function () {
		Route::get('/', 'ProductController@showView')->name('admin.product.form');
		Route::post('getProducts', 'ProductController@getProducts')->name('admin.product.getall');
		Route::get('product-image/{dimension}/{nproductid}/{type}', 'ProductController@showThumbnailImage')->name('admin.product.thumbnail');
	});

	//Categories
	Route::namespace('Categories')->prefix('categories')->group(function () {
		Route::get('/', 'CategoryController@showView')->name('admin.category.form');
		Route::post('getCategory', 'CategoryController@getCategory')->name('admin.category.get');
		Route::post('getListCategories', 'CategoryController@getListCategories')->name('admin.category.getlist');		
		Route::post('getCategories', 'CategoryController@getCategories')->name('admin.category.getall');
		Route::post('saveCategory', 'CategoryController@saveCategory')->name('admin.category.save');
	});
});