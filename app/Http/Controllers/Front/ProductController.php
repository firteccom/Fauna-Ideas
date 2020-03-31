<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Category;

class ProductController extends Controller {

    private function _view_data($data = array()){
        $data_view = [];

        return array_merge($data_view, $data);
    }

    public function showView(){

        /*$categories = $this->getListCategories();

        $data = [
            'categories' => $categories
        ];*/

        return view('portal.detail_product');//, $this->_view_data($data));
    }
}