<?php

	namespace App\Http\Controllers\Admin\Parameter;

	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	//use App\Model\Parameter;

	class ParameterController extends Controller {

		private function _view_data($data = array()){
		  $data_view = [];
	
		  return array_merge($data_view, $data);
		}

        public function showView(){

            //return view('admin.products', $this->_view_data($data));
		}
		

    }
