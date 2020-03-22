<?php

	namespace App\Http\Controllers\Admin\Dashboard;

	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use App\Model\User;


	class DashboardController extends Controller {

        public function index(){
            return view('admin.products');
        }

    }
