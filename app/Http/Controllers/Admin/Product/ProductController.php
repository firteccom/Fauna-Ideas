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
	
			$data = [];
			$data['draw'] = (int)$request->draw;
	
			$data['recordsTotal'] = $this->getProductsFilter($item_por_pag,$pagina,true);
			$data['recordsFiltered'] = $data['recordsTotal'];
	
			$data['data'] = $this->getProductsFilter($item_por_pag,$pagina,false);
	
			return response($data);

		}

		public function getProductsFilter($item_por_pag,$pagina,$contar){
			$data = Product::from('products as prd')
					->join('categories as cat','cat.ncategoryid','=','prd.ncategoryid');
		
			if ($contar){
	
				$data = $data->count();
	
			} else {
	
				$select[] = '*';
				$select[] = 'cat.sname as categoryname';
				$select[] = \DB::raw('CONCAT("",sthumbnail) AS sthumbnailimage');
				$select[] = \DB::raw('CONCAT("",sfullimage) AS simagefull');
				
	
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
                $category = new Category();
                $category->ncategoryparent = $request->categoryparent;
                $category->sname = $request->categoryname;
                $category->sshortdescription = $request->categoryshortdescription;
                $category->sdescription = $request->categorydescription;
                $category->ncreatedby = 1;

                $category->saveAsNew();
                //var_dump($category);

                $data['status'] = 'success';
                $data['msg'] = 'La categoría de registró correctamente.';

            } catch (\Exception $ex) {

                $data['status'] = 'error';
                $data['msg'] = 'No se pudo registrar la categoría '.$ex->getMessage();

            }
                
            return response()->json($data);

        }

        public function updateProduct(Request $request){
            try {
                $data = \DB::connection('mysql')
                        ->table('categories')
                        ->where('ncategoryid',$request->categoryid)
                        ->update(['ncategoryparent'=>$request->categoryparent,
                                  'sname'=>$request->categoryname,
                                  'sshortdescription'=>$request->categoryshortdescription,
                                  'sdescription'=>$request->categorydescription]);

                $resp['status'] = 'success';
                $resp['msg'] = 'La categoría de actualizó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo actualizar la categoría '.$ex->getMessage();

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

    }
