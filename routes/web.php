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

Route::get('/', 'Front\HomeController@_index')->name('front.home'); //http://localhost/Fauna-Ideas/public
//Products
Route::get('products','Front\ProductController@showView');
Route::get('product/{id}','Front\ProductController@productDetail');
Route::post('product/listProducts','Front\ProductController@listProducts')->name('front.product.listproducts');
//Catalog
Route::get('catalog','Front\CatalogController@index');
Route::get('catalog/{id}','Front\CatalogController@showView');
//Contact Us
Route::get('contact-us','Front\ContactController@showView')->name('front.contact.page');
Route::post('send-email','Front\ContactController@sendEmail')->name('front.contact.sendemail');
//About Us
Route::get('about-us','Front\AboutController@showView')->name('front.about.page');
//Blog
Route::get('blog','Front\BlogController@showView')->name('front.blog.page');
Route::get('blog/{id}','Front\BlogController@postDetail')->name('front.blog.detail/{id}');
Route::post('send-comment','Front\BlogController@sendComment')->name('front.blog.sendcomment');
//Categories
Route::get('categories','Front\categoryController@showView');
Route::get('category/{id}','Front\categoryController@categoryDetail');

Route::post('getPostComments2', 'Admin\PostComment\PostCommentController@getPostComments')->name('admin.postcomment.getalltwo');

Route::namespace('Admin')->prefix('admin')->group(function () {
	setlocale(LC_ALL, "es_PE");

	Route::namespace('Auth')->group(function () {
		//Login
		Route::get('login', 'LoginController@form')->name('admin.login'); // http://localhost/Fauna-Ideas/public/admin/login
		Route::post('login', 'LoginController@login');
		Route::get('logout', 'LoginController@destroy')->name('admin.logout');
	});

	Route::middleware(['auth:admin'])->group(function () {

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
			Route::post('highlightProduct', 'ProductController@highlightProduct')->name('admin.product.highlight');
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

			Route::post('importCategory', 'CategoryController@import')->name('admin.category.import');
		});

		//Catalog
		Route::namespace('Catalog')->prefix('catalog')->group(function () {
			Route::get('/', 'CatalogController@showView')->name('admin.catalog.form');
			Route::post('getCatalog', 'CatalogController@getCatalog')->name('admin.catalog.get');	
			Route::post('getCatalogs', 'CatalogController@getCatalogs')->name('admin.catalog.getall');
			Route::post('saveCatalog', 'CatalogController@saveCatalog')->name('admin.catalog.save');
			Route::post('updateCatalog', 'CatalogController@updateCatalog')->name('admin.catalog.update');
			Route::post('desactivateCatalog', 'CatalogController@desactivateCatalog')->name('admin.catalog.desactivate');
			Route::post('activateCatalog', 'CatalogController@activateCatalog')->name('admin.catalog.activate');
			Route::post('getallProducts', 'CatalogController@getallProducts')->name('admin.catalog.getallproducts');
			Route::post('saveProduct', 'CatalogController@saveProduct')->name('admin.catalog.saveproduct');
			Route::post('desactivateProduct', 'CatalogController@desactivateProduct')->name('admin.catalog.desactivateproduct');
		});

		//Slider
		Route::namespace('Slider')->prefix('slider')->group(function () {
			Route::get('/', 'SliderController@showView')->name('admin.slider.form');
			Route::post('getSlide', 'SliderController@getSlide')->name('admin.slider.get');	
			Route::post('getSlides', 'SliderController@getSlides')->name('admin.slider.getall');
			Route::post('saveSlide', 'SliderController@saveSlide')->name('admin.slider.save');
			Route::post('updateSlide', 'SliderController@updateSlide')->name('admin.slider.update');
			Route::post('desactivateSlide', 'SliderController@desactivateSlide')->name('admin.slider.desactivate');
			Route::post('activateSlide', 'SliderController@activateSlide')->name('admin.slider.activate');
			Route::post('getObjects', 'SliderController@getObjects')->name('admin.slider.getobjects');
		});

		//ProductAttribute Attributes
		Route::namespace('ProductAttribute')->prefix('productattribute')->group(function () {
			Route::get('/', 'ProductAttributeController@showView')->name('admin.attribute.form');
			Route::post('getProductAttribute', 'ProductAttributeController@getProductAttribute')->name('admin.productattribute.get');
			Route::post('getListTypes', 'ProductAttributeController@getListTypes')->name('admin.productattribute.getlisttypes');
			Route::post('getListProducts', 'ProductAttributeController@getListProducts')->name('admin.productattribute.getlistproducts');
			Route::post('getProductAttributes', 'ProductAttributeController@getProductAttributes')->name('admin.productattribute.getall');
			Route::post('saveProductAttribute', 'ProductAttributeController@saveProductAttribute')->name('admin.productattribute.save');
			Route::post('updateProductAttribute', 'ProductAttributeController@updateProductAttribute')->name('admin.productattribute.update');
			Route::post('desactivateProductAttribute', 'ProductAttributeController@desactivateProductAttribute')->name('admin.productattribute.desactivate');
			Route::post('activateProductAttribute', 'ProductAttributeController@activateProductAttribute')->name('admin.productattribute.activate');
		});

		//Files
		Route::namespace('File')->prefix('file')->group(function () {
			Route::get('/', 'FileController@showView')->name('admin.file.form');
			Route::get('file-image/{dimension}/{nfileid}/{type}', 'FileController@showThumbnailImage')->name('admin.file.thumbnail');
			Route::post('getFile', 'FileController@getFile')->name('admin.file.get');
			Route::post('getListTypes', 'FileController@getListTypes')->name('admin.file.getlisttypes');
			Route::post('getFiles', 'FileController@getFiles')->name('admin.file.getall');
			Route::post('saveFile', 'FileController@saveFile')->name('admin.file.save');
			Route::post('updateFile', 'FileController@updateFile')->name('admin.file.update');
			Route::post('desactivateFile', 'FileController@desactivateFile')->name('admin.file.desactivate');
			Route::post('activateFile', 'FileController@activateFile')->name('admin.file.activate');
			Route::post('highlightFile', 'FileController@highlightFile')->name('admin.file.highlight');
		});

		//Types
		Route::namespace('Type')->prefix('type')->group(function () {
			Route::get('/', 'TypeController@showView')->name('admin.type.form');
			Route::post('getType', 'TypeController@getType')->name('admin.type.get');
			Route::post('getListTypes', 'TypeController@getListTypes')->name('admin.type.getlist');		
			Route::post('getTypes', 'TypeController@getTypes')->name('admin.type.getall');
			Route::post('saveType', 'TypeController@saveType')->name('admin.type.save');
			Route::post('updateType', 'TypeController@updateType')->name('admin.type.update');
			Route::post('desactivateType', 'TypeController@desactivateType')->name('admin.type.desactivate');
			Route::post('activateType', 'TypeController@activateType')->name('admin.type.activate');
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
			Route::post('getUser', 'UserController@getUser')->name('admin.user.get');
			Route::post('getUsers', 'UserController@getUsers')->name('admin.user.getall');

			Route::post('saveUser', 'UserController@saveUser')->name('admin.user.save');
			Route::post('updateUser', 'UserController@updateUser')->name('admin.user.update');
			Route::post('desactivateUser', 'UserController@desactivateUser')->name('admin.user.desactivate');
			Route::post('activateUser', 'UserController@activateUser')->name('admin.user.activate');
		});

		//Blog Categories
		Route::namespace('BlogCategory')->prefix('blogcategory')->group(function () {
			Route::get('/', 'BlogCategoryController@showView')->name('admin.blogcategory.form');
			Route::post('getBlogCategory', 'BlogCategoryController@getBlogCategory')->name('admin.blogcategory.get');
			Route::post('getListBlogCategories', 'BlogCategoryController@getListBlogCategories')->name('admin.blogcategory.getlist');		
			Route::post('getBlogCategories', 'BlogCategoryController@getBlogCategories')->name('admin.blogcategory.getall');
			Route::post('saveBlogCategory', 'BlogCategoryController@saveBlogCategory')->name('admin.blogcategory.save');
			Route::post('updateBlogCategory', 'BlogCategoryController@updateBlogCategory')->name('admin.blogcategory.update');
			Route::post('desactivateBlogCategory', 'BlogCategoryController@desactivateBlogCategory')->name('admin.blogcategory.desactivate');
			Route::post('activateBlogCategory', 'BlogCategoryController@activateBlogCategory')->name('admin.blogcategory.activate');
		});

		//Posts
		Route::namespace('Post')->prefix('post')->group(function () {
			Route::get('/', 'PostController@showView')->name('admin.post.form');
			Route::get('post-image/{dimension}/{npostid}/{type}', 'PostController@showThumbnailImage')->name('admin.post.thumbnail');
			Route::post('getPost', 'PostController@getPost')->name('admin.post.get');
			Route::post('getListBlogCategories', 'PostController@getListBlogCategories')->name('admin.post.getlistblogcategories');
			Route::post('getPosts', 'PostController@getPosts')->name('admin.post.getall');
			Route::post('savePost', 'PostController@savePost')->name('admin.post.save');
			Route::post('updatePost', 'PostController@updatePost')->name('admin.post.update');
			Route::post('desactivatePost', 'PostController@desactivatePost')->name('admin.post.desactivate');
			Route::post('activatePost', 'PostController@activatePost')->name('admin.post.activate');
			Route::post('highlightPost', 'PostController@highlightPost')->name('admin.post.highlight');
		});

		//PostComments
		Route::namespace('PostComment')->prefix('postcomment')->group(function () {
			Route::get('/', 'PostCommentController@showView')->name('admin.postcomment.form');
			Route::post('getListBlogCategories', 'PostCommentController@getListBlogCategories')->name('admin.postcomment.getlistblogcategories');
			Route::post('getListPosts', 'PostCommentController@getListPosts')->name('admin.postcomment.getlistposts');
			Route::post('getPostComments', 'PostCommentController@getPostComments')->name('admin.postcomment.getall');
			Route::post('desactivatePostComment', 'PostCommentController@desactivatePostComment')->name('admin.postcomment.desactivate');
			Route::post('activatePostComment', 'PostCommentController@activatePostComment')->name('admin.postcomment.activate');
			Route::post('rejectPostComment', 'PostCommentController@rejectPostComment')->name('admin.postcomment.reject');
			Route::post('approvePostComment', 'PostCommentController@approvePostComment')->name('admin.postcomment.approve');
		});

	});

});