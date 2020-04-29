<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Category;

class ProductController extends Controller {

    public function __construct(){
        parent::__construct(); 
    }

    public function showView(){
        $data = [];
        return view('portal.detail_product', parent::_view_data($data));
    }

    public function productDetail($id){

        $product = $this->getProduct($id)['product'];
        $productattributes = $this->getProductAttributes($id)['attributes'];
        $aditionalimages = $this->getProductImages($id)['product'];
        $featuredproducts = $this->getFeaturedProducts($id)['products'];

        $data = [
            'product' => $product,
            'productattributes' => $productattributes,
            'aditionalimages' => $aditionalimages,
            'featuredproducts' => $featuredproducts
        ];

        //echo $product->nproductid;

        if ($this->getProduct($id)['status'] == 'success' && $this->getProduct($id)['product'] != null)
        {
            //echo $this->getProduct($id)['status'];
            
            return view('portal.detail_product', $this->_view_data($data));

        } else {

            return view('portal.product_not_found', $this->_view_data($data));
            
        }

    }

    private function getProduct($id){

        try {

            $data = Product::from('products as prd')
					->join('categories as cat','cat.ncategoryid','=','prd.ncategoryid');
            
            $data = $data->where('prd.nproductid',$id);
    
            $select[] = 'prd.*';
            $select[] = 'cat.ncategoryid as categoryid';
            $select[] = 'cat.sname as category';
                
            $data = $data->select($select)->first();

            $resp['status'] = 'success';
            $resp['msg'] = 'Se obtuvo correctamente el producto.';
            $resp['product'] = $data;

        } catch (\Exception $ex) {

            $resp['status'] = 'error';
            $resp['msg'] = 'No se obtuvo el producto '.$ex->getMessage();
            $resp['product'] = '';
        }

        //var_dump($data);

        return $resp;

    }

    private function getProductAttributes($id){

        try {

            $data = Product::from('product_attribute as attr');
            
            $data = $data->where('attr.nproductid',$id);
    
            $select[] = 'attr.*';
                
            $data = $data->select($select)->get();

            $resp['status'] = 'success';
            $resp['msg'] = 'Se obtuvieron correctamente los atributos.';
            $resp['attributes'] = $data;

        } catch (\Exception $ex) {

            $resp['status'] = 'error';
            $resp['msg'] = 'No se obtuvieron los atributos '.$ex->getMessage();
            $resp['attributes'] = '';
        }

        //var_dump($data);

        return $resp;

    }

    private function getProductImages($id){

        try {

            $data = Product::from('products as prd')
					->join('categories as cat','cat.ncategoryid','=','prd.ncategoryid');
            
            $data = $data->where('prd.nproductid',$id);
    
            $select[] = 'prd.*';
            $select[] = 'cat.ncategoryid as categoryid';
            $select[] = 'cat.sname as category';
                
            $data = $data->select($select)->first();

            $resp['status'] = 'success';
            $resp['msg'] = 'Se obtuvo correctamente el producto.';
            $resp['product'] = $data;

        } catch (\Exception $ex) {

            $resp['status'] = 'error';
            $resp['msg'] = 'No se obtuvo el producto '.$ex->getMessage();
            $resp['product'] = '';
        }

        //var_dump($data);

        return $resp;
    }

    private function getFeaturedProducts(){

        try {

            $data = Product::from('products as prd')
					->join('categories as cat','cat.ncategoryid','=','prd.ncategoryid');
            
            $data = $data->where('prd.shighlighted','Y');
    
            $select[] = 'prd.*';
            $select[] = 'cat.ncategoryid as categoryid';
            $select[] = 'cat.sname as category';
                
            $data = $data->select($select)->get();

            $resp['status'] = 'success';
            $resp['msg'] = 'Se obtuvo correctamente el producto.';
            $resp['products'] = $data;

        } catch (\Exception $ex) {

            $resp['status'] = 'error';
            $resp['msg'] = 'No se obtuvo el producto '.$ex->getMessage();
            $resp['products'] = '';
        }

        //var_dump($data);

        return $resp;
    }

}