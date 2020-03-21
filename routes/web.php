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

Route::get('/', 'Front\HomeController@_index'); //http://localhost/catalogo/public


Route::namespace('Admin')->prefix('admin')->group(function () {
	setlocale(LC_ALL, "es_PE");

	Route::namespace('Auth')->group(function () {

		//Login
		Route::get('login', 'LoginController@form')->name('admin.login'); // http://localhost/catalogo/public/admin/login
		Route::post('login', 'LoginController@login');
		//Route::get('logout', 'LoginController@destroy')->name('admin.logout');

		//Products
		Route::get('products', 'ProductController@showView')->name('admin.product.form');
		Route::post('getProducts', 'ProductController@getProducts')->name('admin.product.getall');
		Route::get('product-image/{dimension}/{nproductid}/{type}', 'ProductController@showThumbnailImage')->name('admin.product.thumbnail');

		//Categories
		Route::get('categories', 'CategoryController@showView')->name('admin.category.form');
		Route::post('getCategory', 'CategoryController@getCategory')->name('admin.category.get');
		Route::post('getListCategories', 'CategoryController@getListCategories')->name('admin.category.getlist');		
		Route::post('getCategories', 'CategoryController@getCategories')->name('admin.category.getall');
		Route::post('saveCategory', 'CategoryController@saveCategory')->name('admin.category.save');

	});


});