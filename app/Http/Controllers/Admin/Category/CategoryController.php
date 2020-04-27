<?php

	namespace App\Http\Controllers\Admin\Category;

	use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
	use App\Http\Controllers\Controller;
	use App\Model\User;
	use App\Model\Category;


	class CategoryController extends Controller {

		public function __construct(){
            parent::__construct(); 
        }

        public function showView(){

            $request = new Request();

            $categories = $this->getListCategories($request);

			$data = [
				'categories' => $categories
            ];
            
            return view('admin.categories', parent::_view_data($data));
		}
		
		public function getCategory(Request $request){

            try {

                $data = Category::from('categories as categoryone');
                
                $data = $data->where('categoryone.ncategoryid',$request->ncategoryid);
        
                $select[] = 'categoryone.*';
                    
                $data = $data->select($select)->first();
    
                $resp['status'] = 'success';
                $resp['msg'] = 'Se obtuvo correctamente la categoría.';
                $resp['category'] = $data;

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se obtuvo la categoría '.$ex->getMessage();
                $resp['category'] = '';
            }

			return response($resp);

		}
		
		public function getCategories(Request $request){

			//$codigousuario = Auth::user()->id;
			$item_por_pag = $request->length;
            $pagina = $request->start;

            $categoryname=$request->categoryname;
            $categoryshortdescription=$request->categoryshortdescription;
            $categorydescription=$request->categorydescription;
            $categorystatus=$request->categorystatus;
	
			$data = [];
			$data['draw'] = (int)$request->draw;
	
			$data['recordsTotal'] = $this->getCategoriesFilter($categoryname,$categoryshortdescription,$categorydescription,$categorystatus,$item_por_pag,$pagina,true);
			$data['recordsFiltered'] = $data['recordsTotal'];
	
			$data['data'] = $this->getCategoriesFilter($categoryname,$categoryshortdescription,$categorydescription,$categorystatus,$item_por_pag,$pagina,false);
	
			return response($data);

		}

		public function getCategoriesFilter($categoryname,$categoryshortdescription,$categorydescription,$categorystatus,$item_por_pag,$pagina,$contar){

            $data = Category::from('categories as categoryone')
                    ->leftJoin('categories as categorytwo','categoryone.ncategoryparent','=','categorytwo.ncategoryid');

            //var_dump($categoryname);

            if(trim($categoryname)!=''){
                $data = $data->where(\DB::raw('UPPER(categoryone.sname)'), 'like', '%'. mb_strtoupper(trim($categoryname)).'%');
            }

            if(trim($categoryshortdescription)!=''){
                $data = $data->where(\DB::raw('UPPER(categoryone.sshortdescription)'), 'like', '%'. mb_strtoupper(trim($categoryshortdescription)).'%');
            }

            if(trim($categorydescription)!=''){
                $data = $data->where(\DB::raw('UPPER(categoryone.sdescription)'), 'like', '%'. mb_strtoupper(trim($categorydescription)).'%');
            }

            if(trim($categorystatus)!=''){
                $data = $data->where(\DB::raw('UPPER(categoryone.sstatus)'), '=', $categorystatus);
            }
		
			if ($contar){
	
				$data = $data->count();
	
			} else {
	
                $select[] = 'categoryone.*';
                $select[] = 'categorytwo.sname as categoryparent';

                
					
				$data = $data->select($select)
				//->orderByRaw('prd.nproductid ASC')
				->offset($pagina)->limit($item_por_pag)
				->get();
			}
	
			return $data;
	
        }
        
        public function getListCategories(Request $request){

            $data = Category::from('categories');

            if ($request->id != null){
            
                $data = $data->where('ncategoryid','<>',$request->id);

            }
	
            $select[] = '*';
            
            $data = $data->select($select)
            
            ->get();
	
			return $data;

        }

        public function saveCategory(Request $request){

            try {
                $category = new Category();
                $category->ncategoryparent = $request->categoryparent;
                $category->sname = $request->categoryname;
                $category->sshortdescription = $request->categoryshortdescription;
                $category->sdescription = $request->categorydescription;
                $category->sfullimage = $request->categoryfullimage;
                $category->dcreatedon = @date('Y-m-d H:i:s');
				$category->ncreatedby = Auth::user()->nuserid;

                $category->saveAsNew();

                $data['status'] = 'success';
                $data['msg'] = 'La categoría se registró correctamente.';

            } catch (\Exception $ex) {

                $data['status'] = 'error';
                $data['msg'] = 'No se pudo registrar la categoría '.$ex->getMessage();

            }
                
            return response()->json($data);

        }

        public function updateCategory(Request $request){
            try {
                $data = \DB::connection('mysql')
                        ->table('categories')
                        ->where('ncategoryid',$request->categoryid)
                        ->update(['ncategoryparent'=>$request->categoryparent,
                                  'sname'=>$request->categoryname,
                                  'sshortdescription'=>$request->categoryshortdescription,
                                  'sfullimage' => $request->categoryfullimage,
                                  'sdescription'=>$request->categorydescription,
                                  'dmodifiedon'=>@date('Y-m-d H:i:s'),
                                  'nmodifiedby'=>Auth::user()->nuserid]);

                $resp['status'] = 'success';
                $resp['msg'] = 'La categoría se actualizó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo actualizar la categoría '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

        public function desactivateCategory(Request $request){
            try {
                $data = \DB::connection('mysql')->table('categories')->where('ncategoryid',$request->id)->update(['sstatus'=>'N','nmodifiedby'=>Auth::user()->nuserid]);

                $resp['status'] = 'success';
                $resp['msg'] = 'La categoría se desactivó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo desactivar la categoría '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

        public function activateCategory(Request $request){
            try {
                $data = \DB::connection('mysql')->table('categories')->where('ncategoryid',$request->id)->update(['sstatus'=>'A','nmodifiedby'=>Auth::user()->nuserid]);

                $resp['status'] = 'success';
                $resp['msg'] = 'La categoría se activó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo activar la categoría '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

    }
