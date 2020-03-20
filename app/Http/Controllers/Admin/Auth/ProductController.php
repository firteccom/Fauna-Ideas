<?php

	namespace App\Http\Controllers\Admin\Auth;

	use App\Http\Controllers\Controller;
	use App\Http\Requests\Admin\Login\ProductRequest;
	use App\Model\User;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Hash;


	class ProductController extends Controller {


        public function showView(){
            return view('admin.products');
        }

    }
