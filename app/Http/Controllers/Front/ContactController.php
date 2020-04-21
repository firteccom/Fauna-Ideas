<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller {

    private function _view_data($data = array()){
        $data_view = [];

        return array_merge($data_view, $data);
    }

    public function showView(){

        /*$categories = $this->getListCategories();

        $data = [
            'categories' => $categories
        ];*/

        return view('portal.contact_us');//, $this->_view_data($data));
    }

}