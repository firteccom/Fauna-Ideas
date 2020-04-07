<?php

	namespace App\Http\Controllers\Admin\Product;

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

			$categories = $this->getListCategories();

			$data = [
				'categories' => $categories
			];

            return view('admin.products', $this->_view_data($data));
		}
		
		public function getProduct(Request $request){

            try {

                $data = Product::from('products as prd');
                
                $data = $data->where('prd.nproductid',$request->nproductid);
        
                $select[] = 'prd.*';
                    
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

			return response($resp);

		}
		
		public function getProducts(Request $request){

			//$codigousuario = Auth::user()->id;
			$item_por_pag = $request->length;
			$pagina = $request->start;

			$productname = $request->productname;
			$productcategory = $request->productcategory;
			$productsku = $request->productsku;
			$productstatus = $request->productstatus;
	
			$data = [];
			$data['draw'] = (int)$request->draw;

			$data['recordsTotal'] = $this->getProductsFilter($productname,$productcategory,$productsku,$productstatus,$item_por_pag,$pagina,true);
			$data['recordsFiltered'] = $data['recordsTotal'];
	
			$data['data'] = $this->getProductsFilter($productname,$productcategory,$productsku,$productstatus,$item_por_pag,$pagina,false);
	
			return response($data);

		}

		public function getProductsFilter($productname,$productcategory,$productsku,$productstatus,$item_por_pag,$pagina,$contar){
			$data = Product::from('products as prd')
					->join('categories as cat','cat.ncategoryid','=','prd.ncategoryid');

			if(trim($productname)!=''){
				$data = $data->where(\DB::raw('UPPER(prd.sname)'), 'like', '%'. mb_strtoupper(trim($productname)).'%');
			}

			if(trim($productcategory)!='' && $productcategory!=0){
				$data = $data->where(\DB::raw('UPPER(prd.ncategoryid)'), '=', $productcategory);
			}

			if(trim($productsku)!=''){
				$data = $data->where(\DB::raw('UPPER(prd.ssku)'), 'like', '%'. mb_strtoupper(trim($productsku)).'%');
			}

			if(trim($productstatus)!=''){
				$data = $data->where(\DB::raw('UPPER(prd.sstatus)'), '=', $productstatus);
			}
		
			if ($contar){
	
				$data = $data->count();
	
			} else {
	
				$select[] = 'prd.*';
				$select[] = 'cat.sname as categoryname';
				$select[] = \DB::raw('CONCAT("",prd.sthumbnail) AS sthumbnailimage');
				$select[] = \DB::raw('CONCAT("",prd.sfullimage) AS simagefull');
				
	
				$data = $data->select($select)
				//->orderByRaw('prd.nproductid ASC')
				->offset($pagina)->limit($item_por_pag)
				->get();
			}

	
			return $data;
	
		}

		public function getProductImage($id){
			return "";
		}
        
        public function getListCategories(){

            $data = Category::from('categories');
            
            $data = $data->where('sstatus','A');
	
            $select[] = '*';
            
            $data = $data->select($select)
            
            ->get();
	
			return $data;

        }

        public function saveProduct(Request $request){

            try {
                $product = new Product();
				$product->ncategoryid = $request->productcategory;
				$product->scategoryname = $request->productcategoryname;
				$product->nsellerid = 1;
				$product->ssku = $request->productsku;
				$product->sname = $request->productname;
				$product->sdescription = $request->productdescription;
				$product->sfullimage = $request->productfullimage;
				$product->sthumbnail = $request->productthumbnail;
				$product->nmasterprice = $request->productmasterprice;
				$product->nprice = $request->productprice;
				$product->ncreatedby = 1;
				
                $product->saveAsNew();
                //var_dump($product);

                $data['status'] = 'success';
                $data['msg'] = 'El producto se registró correctamente.';

            } catch (\Exception $ex) {

                $data['status'] = 'error';
                $data['msg'] = 'No se pudo registrar el producto '.$ex->getMessage();

            }
                
            return response()->json($data);

        }

        public function updateProduct(Request $request){
            try {
                $data = \DB::connection('mysql')
                        ->table('products')
                        ->where('nproductid',$request->productid)
						->update(['ncategoryid'=>$request->productcategory,
								  'scategoryname'=>$request->productcategoryname,
								  'nsellerid'=>1,
								  'ssku'=>$request->productsku,
								  'sname'=>$request->productname,
								  'sdescription'=>$request->productdescription,
								  'sfullimage'=>$request->productfullimage,
								  'sthumbnail'=>$request->productthumbnail,
								  'nmasterprice'=>$request->productmasterprice,
								  'nprice'=>$request->productprice]);
								  
                $resp['status'] = 'success';
                $resp['msg'] = 'El producto se actualizó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo actualizar el producto '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

        public function desactivateProduct(Request $request){
            try {
                $data = \DB::connection('mysql')->table('products')->where('nproductid',$request->id)->update(['sstatus'=>'N']);

                $resp['status'] = 'success';
                $resp['msg'] = 'El producto se desactivó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo desactivar el producto '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

        public function activateProduct(Request $request){
            try {
                $data = \DB::connection('mysql')->table('products')->where('nproductid',$request->id)->update(['sstatus'=>'A']);

                $resp['status'] = 'success';
                $resp['msg'] = 'El producto se activó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo activar el producto '.$ex->getMessage();

            }
                
            return response()->json($resp);
		}

		public function highlightProduct(Request $request){

			$flag = 'Y';
			$msg = 'El producto fue destacado.';

			if($request->high == 'Y'){ $flag = 'N'; $msg = 'El producto fue quitado de los destacados.';}


			 try {
                $data = \DB::connection('mysql')->table('products')->where('nproductid',$request->id)->update(['shighlighted'=>$flag]);

                $resp['status'] = 'success';
                $resp['msg'] = $msg;

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo modificar el producto '.$ex->getMessage();
            }
            
            return response()->json($resp);
		}

    }
