<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Category;

class AboutController extends Controller {

    public function __construct(){
        parent::__construct(); 
    }

    private function _view_data($data = array()){
        $data_view = [];

        return array_merge($data_view, $data);
    }

    public function showView(){
        
        return view('portal.about_us')->with($this->data_general);
    }

}