<?php

	namespace App\Http\Controllers\Admin\Product;

	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Hash;
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
			$data = Product::from('products');
		
			if ($contar){
	
				$data = $data->count();
	
			} else {
	
				$select[] = '*';
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

    }
