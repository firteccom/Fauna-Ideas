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
		Route::get('product-image/{dimension}/{nproductid}/{type}', 'ProductController@showThumbnailImage')->name('admin.product.thumbnail');
		Route::post('getProduct', 'ProductController@getProduct')->name('admin.product.get');
		Route::post('getListCategories', 'ProductController@getListCategories')->name('admin.product.getlistcategories');
		Route::post('getProducts', 'ProductController@getProducts')->name('admin.product.getall');
		Route::post('saveProduct', 'ProductController@saveProduct')->name('admin.product.save');
		Route::post('updateProduct', 'ProductController@updateProduct')->name('admin.product.update');
		Route::post('desactivateProduct', 'ProductController@desactivateProduct')->name('admin.product.desactivate');
		Route::post('activateProduct', 'ProductController@activateProduct')->name('admin.product.activate');
	});

	//Categories
	Route::namespace('Category')->prefix('category')->group(function () {
		Route::get('/', 'CategoryController@showView')->name('admin.category.form');
		Route::post('getCategory', 'CategoryController@getCategory')->name('admin.category.get');
		Route::post('getListCategories', 'CategoryController@getListCategories')->name('admin.category.getlist');		
		Route::post('getCategories', 'CategoryController@getCategories')->name('admin.category.getall');
		Route::post('saveCategory', 'CategoryController@saveCategory')->name('admin.category.save');
		Route::post('updateCategory', 'CategoryController@updateCategory')->name('admin.category.update');
		Route::post('desactivateCategory', 'CategoryController@desactivateCategory')->name('admin.category.desactivate');
		Route::post('activateCategory', 'CategoryController@activateCategory')->name('admin.category.activate');
	});

	//Parameters
	Route::namespace('Parameter')->prefix('parameter')->group(function () {
		Route::get('/', 'ParameterController@showView')->name('admin.parameter.form');
		Route::post('getParameter', 'ParameterController@getParameter')->name('admin.parameter.get');
		Route::post('getParameters', 'ParameterController@getParameters')->name('admin.parameter.getall');
		Route::post('saveParameter', 'ParameterController@saveParameter')->name('admin.parameter.save');
		Route::post('updateParameter', 'ParameterController@updateParameter')->name('admin.parameter.update');
		Route::post('desactivateParameter', 'ParameterController@desactivateParameter')->name('admin.parameter.desactivate');
		Route::post('activateParameter', 'ParameterController@activateParameter')->name('admin.parameter.activate');
	});

	//Users
	Route::namespace('User')->prefix('user')->group(function () { 
		Route::get('/', 'UserController@showView')->name('admin.user.form');
		Route::post('datatable', 'UserController@datatable')->name('admin.user.datatable');
		Route::post('create', 'UserController@create')->name('admin.user.create');
		Route::post('edit', 'UserController@edit')->name('admin.user.edit');
		Route::post('save', 'UserController@save')->name('admin.user.save');
		Route::post('remove', 'UserController@remove')->name('admin.user.remove');
		Route::post('enable', 'UserController@enable')->name('admin.user.enable');
	});

});