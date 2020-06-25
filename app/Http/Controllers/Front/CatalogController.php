<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\Catalog;
use App\Model\Product;

class CatalogController extends Controller {

    public function __construct(){
        parent::__construct(); 
    }

    public function showView($id){

        $catalog = $this->getCatalog($id)['catalog'];
        $data = ['catalog'=>$catalog];


        if ($this->getCatalog($id)['status'] == 'success' && $this->getCatalog($id)['catalog'] != null){
            return view('portal.catalog_detail', parent::_view_data($data));
        } else {
            return view('portal.catalog_not_found', $this->_view_data($data));
        }   
    }


    public function getCatalog($id){

        try {

            $data = Catalog::from('catalog as cat');
            
            $data = $data->where('cat.ncatalogid',$id);
    
            $select[] = 'cat.*';
                
            $data = $data->select($select)->first();

            $resp['status'] = 'success';
            $resp['msg'] = 'Se obtuvo correctamente el catálogo.';
            $resp['catalog'] = $data;

        } catch (\Exception $ex) {

            $resp['status'] = 'error';
            $resp['msg'] = 'No se obtuvo el catálogo '.$ex->getMessage();
            $resp['catalog'] = '';
        }

        return $resp;

    }


}