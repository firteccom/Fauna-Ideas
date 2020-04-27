<?php

	namespace App\Http\Controllers\Front;

	use Exception;
	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	

	class HomeController extends Controller {

		public function __construct(){
            parent::__construct(); 
        }

		public function _index(){
			$data = [];
			return view('portal._index', parent::_view_data($data));									
		}
	}