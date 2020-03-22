<?php

	namespace App\Http\Controllers\Admin\Product;

	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use App\Model\User;


	class ProductController extends Controller {


        public function showView(){
            return view('admin.products');
        }

    }
