<?php

	namespace App\Http\Controllers\Admin\BlogCategory;

	use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
	use App\Http\Controllers\Controller;
	use App\Model\User;
	use App\Model\BlogCategory;	


	class BlogCategoryController extends Controller {

		private function _view_data($data = array()){
		  $data_view = [];
	
		  return array_merge($data_view, $data);
		}

        public function showView(){

            $request = new Request();

            $blogcategories = $this->getListBlogCategories($request);

			$data = [
				'blogcategories' => $blogcategories
            ];
            
            return view('admin.blog_categories', $this->_view_data($data));
		}
		
		public function getBlogCategory(Request $request){

            try {

                $data = BlogCategory::from('blog_categories as blogblogcategoryone');
                
                $data = $data->where('blogblogcategoryone.nblogcategoryid',$request->nblogcategoryid);
        
                $select[] = 'blogblogcategoryone.*';
                    
                $data = $data->select($select)->first();
    
                $resp['status'] = 'success';
                $resp['msg'] = 'Se obtuvo correctamente la categoría de blog.';
                $resp['blogcategory'] = $data;

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se obtuvo la categoría de blog '.$ex->getMessage();
                $resp['blogcategory'] = '';
            }

			return response($resp);

		}
		
		public function getBlogCategories(Request $request){

			//$codigousuario = Auth::user()->id;
			$item_por_pag = $request->length;
            $pagina = $request->start;

            $blogcategoryname=$request->blogcategoryname;
            $blogcategoryshortdescription=$request->blogcategoryshortdescription;
            $blogcategorydescription=$request->blogcategorydescription;
            $blogcategorystatus=$request->blogcategorystatus;
	
			$data = [];
			$data['draw'] = (int)$request->draw;
	
			$data['recordsTotal'] = $this->getBlogCategoriesFilter($blogcategoryname,$blogcategoryshortdescription,$blogcategorydescription,$blogcategorystatus,$item_por_pag,$pagina,true);
			$data['recordsFiltered'] = $data['recordsTotal'];
	
			$data['data'] = $this->getBlogCategoriesFilter($blogcategoryname,$blogcategoryshortdescription,$blogcategorydescription,$blogcategorystatus,$item_por_pag,$pagina,false);
	
			return response($data);

		}

		public function getBlogCategoriesFilter($blogcategoryname,$blogcategoryshortdescription,$blogcategorydescription,$blogcategorystatus,$item_por_pag,$pagina,$contar){

            $data = BlogCategory::from('blog_categories as blogcategoryone')
                    ->leftJoin('blog_categories as blogcategorytwo','blogcategoryone.nblogcategoryparentid','=','blogcategorytwo.nblogcategoryid');

            //var_dump($blogcategoryname);

            if(trim($blogcategoryname)!=''){
                $data = $data->where(\DB::raw('UPPER(blogcategoryone.sname)'), 'like', '%'. mb_strtoupper(trim($blogcategoryname)).'%');
            }

            if(trim($blogcategoryshortdescription)!=''){
                $data = $data->where(\DB::raw('UPPER(blogcategoryone.sshortdescription)'), 'like', '%'. mb_strtoupper(trim($blogcategoryshortdescription)).'%');
            }

            if(trim($blogcategorydescription)!=''){
                $data = $data->where(\DB::raw('UPPER(blogcategoryone.sdescription)'), 'like', '%'. mb_strtoupper(trim($blogcategorydescription)).'%');
            }

            if(trim($blogcategorystatus)!=''){
                $data = $data->where(\DB::raw('UPPER(blogcategoryone.sstatus)'), '=', $blogcategorystatus);
            }
		
			if ($contar){
	
				$data = $data->count();
	
			} else {
	
                $select[] = 'blogcategoryone.*';
                $select[] = 'blogcategorytwo.sname as blogcategoryparent';

                
					
				$data = $data->select($select)
				//->orderByRaw('prd.nproductid ASC')
				->offset($pagina)->limit($item_por_pag)
				->get();
			}
	
			return $data;
	
        }
        
        public function getListBlogCategories(Request $request){

            $data = BlogCategory::from('blog_categories');

            if ($request->id != null){
            
                $data = $data->where('nblogcategoryid','<>',$request->id);

            }
	
            $select[] = '*';
            
            $data = $data->select($select)
            
            ->get();
	
			return $data;

        }

        public function saveBlogCategory(Request $request){

            try {
                $blogcategory = new BlogCategory();
                $blogcategory->nblogcategoryparentid = $request->blogcategoryparentid;
                $blogcategory->sname = $request->blogcategoryname;
                $blogcategory->sshortdescription = $request->blogcategoryshortdescription;
                $blogcategory->sdescription = $request->blogcategorydescription;
                $blogcategory->sfullimage = $request->blogcategoryfullimage;
                $blogcategory->dcreatedon = @date('Y-m-d H:i:s');
				$blogcategory->ncreatedby = Auth::user()->nuserid;

                $blogcategory->saveAsNew();

                $data['status'] = 'success';
                $data['msg'] = 'La categoría de blog se registró correctamente.';

            } catch (\Exception $ex) {

                $data['status'] = 'error';
                $data['msg'] = 'No se pudo registrar la categoría de blog '.$ex->getMessage();

            }
                
            return response()->json($data);

        }

        public function updateBlogCategory(Request $request){
            try {
                $data = \DB::connection('mysql')
                        ->table('blog_categories')
                        ->where('nblogcategoryid',$request->blogcategoryid)
                        ->update(['nblogcategoryparentid'=>$request->blogcategoryparentid,
                                  'sname'=>$request->blogcategoryname,
                                  'sshortdescription'=>$request->blogcategoryshortdescription,
                                  'sfullimage' => $request->blogcategoryfullimage,
                                  'sdescription'=>$request->blogcategorydescription,
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

        public function desactivateBlogCategory(Request $request){
            try {
                $data = \DB::connection('mysql')->table('blog_categories')->where('nblogcategoryid',$request->id)->update(['sstatus'=>'N','nmodifiedby'=>Auth::user()->nuserid]);

                $resp['status'] = 'success';
                $resp['msg'] = 'La categoría de blog se desactivó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo desactivar la categoría de blog '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

        public function activateBlogCategory(Request $request){
            try {
                $data = \DB::connection('mysql')->table('blog_categories')->where('nblogcategoryid',$request->id)->update(['sstatus'=>'A','nmodifiedby'=>Auth::user()->nuserid]);

                $resp['status'] = 'success';
                $resp['msg'] = 'La categoría de blog se activó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo activar la categoría de blog '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

    }
