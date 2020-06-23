<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Category;

class CategoryController extends Controller {

    public function __construct(){
        parent::__construct(); 
    }

    public function showView(){
        $data = [];
        return view('portal.category_detail', parent::_view_data($data));
    }

    public function categoryDetail($id){

        $product = $this->getProduct($id)['product'];
        $category = $this->getCategory($id)['category'];
        $categoryproducts = $this->getProductsByCategory($id)['products'];
        $productattributes = $this->getProductAttributes($id)['attributes'];
        $aditionalimages = $this->getProductImages($id)['product'];
        $featuredproducts = $this->getFeaturedProducts($id)['products'];
        $filterbrand = $this->getAttributeValues($id,1)['attributes'];
        $filtersize = $this->getAttributeValues($id,2)['attributes'];
        $filteryear = $this->getAttributeValues($id,3)['attributes'];
        $filtercolor = $this->getAttributeValues($id,4)['attributes'];

        $data = [
            'product' => $product,
            'category' => $category,
            'categoryproducts' => $categoryproducts,
            'productattributes' => $productattributes,
            'aditionalimages' => $aditionalimages,
            'featuredproducts' => $featuredproducts,
            'filterbrand'=>$filterbrand,
            'filtersize'=>$filtersize,
            'filteryear'=>$filteryear,
            'filtercolor'=>$filtercolor
        ];

        //echo $product->nproductid;

        if ($this->getCategory($id)['status'] == 'success' && $this->getCategory($id)['category'] != null)
        {
            
            return view('portal.category_detail', $this->_view_data($data));

        } else {

            return view('portal.category_not_found', $this->_view_data($data));
            
        }

    }

    private function getCategory($id){

        try {

            $data = Category::from('categories as cat');
            
            $data = $data->where('cat.ncategoryid',$id);
    
            $select[] = 'cat.*';
                
            $data = $data->select($select)->first();

            $resp['status'] = 'success';
            $resp['msg'] = 'Se obtuvo correctamente la categoría.';
            $resp['category'] = $data;

        } catch (\Exception $ex) {

            $resp['status'] = 'error';
            $resp['msg'] = 'No se obtuvo la categoría '.$ex->getMessage();
            $resp['category'] = '';
        }

        //var_dump($data);

        return $resp;

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

    private function getProductsByCategory($id){

        try {

            $data = Product::from('products as prd');
            
            $data = $data->where('prd.ncategoryid',$id);
    
            $select[] = 'prd.*';
                
            $data = $data->select($select)->get();

            $resp['status'] = 'success';
            $resp['msg'] = 'Se obtuvieron correctamente los productos.';
            $resp['products'] = $data;

        } catch (\Exception $ex) {

            $resp['status'] = 'error';
            $resp['msg'] = 'No se obtuvieron el losoductos '.$ex->getMessage();
            $resp['products'] = '';
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

    private function getAttributeValues($id,$type){

        $typefilter = '';

        try {

            $data = Product::from('products as prd')
					->join('product_attribute as prdatt','prdatt.nproductid','=','prd.nproductid')
					->join('categories as cat','cat.ncategoryid','=','prd.ncategoryid');
            
            $data = $data->where('cat.ncategoryid',$id);

            switch ($type) {
                case 1:
                    $typefilter = 'Marca';
                    break;
                case 2:
                    $typefilter = 'Tamaño';
                    break;
                case 3:
                    $typefilter = 'Año';
                    break;
                case 3:
                    $typefilter = 'Color';
                    break;
            }

            $data = $data->where('cat.ncategoryid',$id);
            $data = $data->where('prdatt.sname',$typefilter);
    
            $select[] = 'prdatt.svalue';
                
            $data = $data->select($select)->distinct()->get();

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

}