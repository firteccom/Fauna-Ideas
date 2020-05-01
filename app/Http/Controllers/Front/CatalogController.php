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

    public function index(){
    	$this->showView(1);
    }

    public function showView($id){

        $catalog = $this->getCatalog($id)['catalog'];

        $data = ['catalog'=>$catalog];

        return view('portal.catalog', parent::_view_data($data));
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


    public function listProducts(Request $request){
    	$limite = 1;
    	$result = [];
    	$result['limite'] = $limite;

    	//$result['total'] = $this->_lista($request->ubigeo, $request->nombre, $request->tipo_espacio,0, 0, true);
    	$result['total'] = $this->_lista(0, 0, true);

    	$actual = (int)$request->pagina;
    	if($actual<=0){
    		$actual = 1;
    	}
    	$inicio = ($actual-1) * $limite; 



    	//$result['data'] = $this->_lista($request->ubigeo,$request->nombre, $request->tipo_espacio, $limite, $inicio, false);
    	

    	$result['data'] = $this->_lista($limite, $inicio, false);

    	$result['paginas'] = ceil($result['total']/$result['limite']);
    	$result['pagina'] = $actual;
    	$result['inicio'] = $inicio;

    	return response()->json($result);


    }


    private function _lista($limite, $inicio, $contar = false){

      	$data = Product::from('products as prd')->where('prd.sstatus', 'A')->join('categories as cat','cat.ncategoryid','=','prd.ncategoryid')->where('prd.shighlighted','Y');


	   /* if((int)$tipo_espacio > 0){
	        $data = $data->where('E.ncodtipoespacio', $tipo_espacio);
	    }

        if(isset($nombre) && trim($nombre)!=''){
            $nombre = trim($nombre);
            $data = $data->where(function($query) use($nombre){
            	$query->where(DB::raw('UPPER(E.snombre)'), 'like', '%'.mb_strtoupper(trim($nombre)).'%');
            });
        }*/

    	if(!$contar){

    		$select = [];
    		$select[] = 'prd.*';
    		$select[] = DB::raw('cat.ncategoryid as categoryid');
    		$select[] = DB::raw('cat.sname as category');
    		$data = $data->select($select)
                  ->offset($inicio)->limit($limite)
                  ->orderByRaw('2 ASC, 1 ASC')->get();
    	}else{
    		$data = $data->count();
    	}

    	return $data;

    }


}