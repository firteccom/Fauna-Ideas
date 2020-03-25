<?php

	namespace App\Http\Controllers\Admin\ProductAttribute;

	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use App\Model\ProductAttribute;
	use App\Model\Product;
	use App\Model\Type;

	class ProductAttributeController extends Controller {

		private function _view_data($data = array()){
		  $data_view = [];
	
		  return array_merge($data_view, $data);
		}

        public function showView(){

			$types = $this->getListTypes();
			$products = $this->getListProducts();

			$data = [
				'types' => $types,
				'products' => $products
			];

            return view('admin.productattributes', $this->_view_data($data));
		}
		
		public function getProductAttribute(Request $request){

            try {

                $data = Product::from('product_attribute');
                
                $data = $data->where('nproductattributeid',$request->nproductattributeid);
        
                $select[] = '*';
                    
                $data = $data->select($select)->first();
    
                $resp['status'] = 'success';
                $resp['msg'] = 'Se obtuvo correctamente el atributo del producto.';
                $resp['productattribute'] = $data;

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se obtuvo el atributo del producto '.$ex->getMessage();
                $resp['productattribute'] = '';
            }
    
            //var_dump($data);

			return response($resp);

		}
		
		public function getProductAttributes(Request $request){

			//$codigousuario = Auth::user()->id;
			$item_por_pag = $request->length;
			$pagina = $request->start;

			$productattributename = $request->productattributename;
			$productattributevalue = $request->productattributevalue;
			$productattributetype = $request->productattributetype;
			$productattributeproduct = $request->productattributeproduct;
			$productattributeflag = $request->productattributeflag;
			$productattributestatus = $request->productattributestatus;

			$data = [];
			$data['draw'] = (int)$request->draw;

			$data['recordsTotal'] = $this->getProductAttributesFilter($productattributename,$productattributevalue,$productattributetype,$productattributeproduct,$productattributeflag,$productattributestatus,$item_por_pag,$pagina,true);
			$data['recordsFiltered'] = $data['recordsTotal'];
	
			$data['data'] = $this->getProductAttributesFilter($productattributename,$productattributevalue,$productattributetype,$productattributeproduct,$productattributeflag,$productattributestatus,$item_por_pag,$pagina,false);
	
			return response($data);

		}

		public function getProductAttributesFilter($productattributename,$productattributevalue,$productattributetype,$productattributeproduct,$productattributeflag,$productattributestatus,$item_por_pag,$pagina,$contar){
			$data = ProductAttribute::from('product_attribute as prdatr')
					->leftJoin('products as prd','prd.nproductid','=','prdatr.nproductid')
					->leftJoin('types as typ','typ.ntypeid','=','prdatr.ntypeid');

			if(trim($productattributename)!=''){
				$data = $data->where(\DB::raw('UPPER(prdatr.sname)'), 'like', '%'. mb_strtoupper(trim($productattributename)).'%');
			}

			if(trim($productattributevalue)!=''){
				$data = $data->where(\DB::raw('UPPER(prdatr.svalue)'), 'like', '%'. mb_strtoupper(trim($productattributevalue)).'%');
			}

			if(trim($productattributeproduct)!='' && $productattributeproduct!=0){
				$data = $data->where(\DB::raw('UPPER(prdatr.nproductid)'), '=', $productattributeproduct);
			}

			if(trim($productattributetype)!='' && $productattributetype!=0){
				$data = $data->where(\DB::raw('UPPER(prdatr.ntypeid)'), '=', $productattributetype);
			}

			if(trim($productattributeflag)!=''){
				$data = $data->where(\DB::raw('UPPER(prdatr.sflagdescriptive)'), '=', $productattributeflag);
			}

			if(trim($productattributestatus)!=''){
				$data = $data->where(\DB::raw('UPPER(prdatr.sstatus)'), '=', $productattributestatus);
			}
		
			if ($contar){
	
				$data = $data->count();
	
			} else {
	
				$select[] = 'prdatr.*';
				$select[] = 'prd.sname as productname';
				$select[] = 'typ.sname as typename';
				
	
				$data = $data->select($select)
				//->orderByRaw('prd.nproductid ASC')
				->offset($pagina)->limit($item_por_pag)
				->get();
			}

	
			return $data;
	
		}
        
        public function getListTypes(){

            $data = Type::from('types');
            
            $data = $data->where('sstatus','A');
			
			//Filter only product attribute types
            $data = $data->where('ntypeparentid',4);
	
            $select[] = '*';
            
            $data = $data->select($select)
            
            ->get();
	
			return $data;

        }
        
        public function getListProducts(){

            $data = Product::from('products');
            
            $data = $data->where('sstatus','A');
	
            $select[] = '*';
            
            $data = $data->select($select)
            
            ->get();
	
			return $data;

        }

        public function saveProductAttribute(Request $request){

            try {
				$productattribute = new ProductAttribute();
				$productattribute->nproductid = $request->productattributeproduct;
				$productattribute->sname = $request->productattributename;
				$productattribute->svalue = $request->productattributevalue;
				$productattribute->ntypeid = $request->productattributetype;
				$productattribute->stypename = $request->productattributetypename;
				$productattribute->sflagdescriptive = 0;				
				$productattribute->ncreatedby = 1;
				
                $productattribute->saveAsNew();
                //var_dump($product);

                $data['status'] = 'success';
                $data['msg'] = 'El atributo del producto se registró correctamente.';

            } catch (\Exception $ex) {

                $data['status'] = 'error';
                $data['msg'] = 'No se pudo registrar el atributo del producto '.$ex->getMessage();

            }
                
            return response()->json($data);

        }

        public function updateProductAttribute(Request $request){
            try {
                $data = \DB::connection('mysql')
                        ->table('product_attribute')
                        ->where('nproductattributeid',$request->nproductattributeid)
						->update(['nproductid'=>$request->productattributeproduct,
								 'sname'=>$request->productattributename,
								 'svalue'=>$request->productattributevalue,
								 'ntypeid'=>$request->productattributetype,
								 'stypename'=>$request->productattributetypename]);
								  
                $resp['status'] = 'success';
                $resp['msg'] = 'El atributo del producto se actualizó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo actualizar el atributo del producto '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

        public function desactivateProductAttribute(Request $request){
            try {
                $data = \DB::connection('mysql')->table('product_attribute')->where('nproductattributeid',$request->id)->update(['sstatus'=>'N']);

                $resp['status'] = 'success';
                $resp['msg'] = 'El atributo del producto se desactivó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo desactivar el atributo del producto '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

        public function activateProductAttribute(Request $request){
            try {
                $data = \DB::connection('mysql')->table('product_attribute')->where('nproductattributeid',$request->id)->update(['sstatus'=>'A']);

                $resp['status'] = 'success';
                $resp['msg'] = 'El atributo del producto se activó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo activar el atributo del producto '.$ex->getMessage();

            }
                
            return response()->json($resp);
		}

    }
