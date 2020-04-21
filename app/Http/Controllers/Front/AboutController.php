<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
	use App\Model\Category;

class AboutController extends Controller {

    private function _view_data($data = array()){
        $data_view = [];

        return array_merge($data_view, $data);
    }

    public function showView(){
        
        $categories = Category::where('sstatus', 'A')->get();

        /*$categories = $this->getListCategories();*/

        $data = [
            'categories' => $categories
        ];

        return view('portal.about_us', $this->_view_data($data));
    }

}