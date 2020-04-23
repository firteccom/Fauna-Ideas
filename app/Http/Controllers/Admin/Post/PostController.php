<?php

	namespace App\Http\Controllers\Admin\Post;

	use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
	use App\Http\Controllers\Controller;
	use App\Model\Post;
	use App\Model\BlogCategory;

	class PostController extends Controller {

		private function _view_data($data = array()){
		  $data_view = [];
	
		  return array_merge($data_view, $data);
		}

        public function showView(){

			$blogcategories = $this->getListBlogCategories();

			$data = [
				'blogcategories' => $blogcategories
			];

            return view('admin.posts', $this->_view_data($data));
		}
		
		public function getPost(Request $request){

            try {

                $data = Post::from('posts as pst');
                
                $data = $data->where('pst.npostid',$request->npostid);
        
                $select[] = 'pst.*';
                    
                $data = $data->select($select)->first();
    
                $resp['status'] = 'success';
                $resp['msg'] = 'Se obtuvo correctamente la publicación.';
                $resp['post'] = $data;

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se obtuvo la publicación '.$ex->getMessage();
                $resp['post'] = '';
            }
    
            //var_dump($data);

			return response($resp);

		}
		
		public function getPosts(Request $request){

			//$codigousuario = Auth::user()->id;
			$item_por_pag = $request->length;
			$pagina = $request->start;

			$posttitle = $request->posttitle;
			$postdescription = $request->postdescription;
			$blogcategoryid = $request->blogcategoryid;
			$posttag = $request->posttag;
			$postuser = $request->postuser;
			$poststatus = $request->poststatus;
	
			$data = [];
			$data['draw'] = (int)$request->draw;

			$data['recordsTotal'] = $this->getPostsFilter($posttitle,$postdescription,$blogcategoryid,$posttag,$postuser,$poststatus,$item_por_pag,$pagina,true);
			$data['recordsFiltered'] = $data['recordsTotal'];
	
			$data['data'] = $this->getPostsFilter($posttitle,$postdescription,$blogcategoryid,$posttag,$postuser,$poststatus,$item_por_pag,$pagina,false);
	
			return response($data);

		}

		public function getPostsFilter($posttitle,$postdescription,$blogcategoryid,$posttag,$postuser,$poststatus,$item_por_pag,$pagina,$contar){
			$data = Post::from('posts as pst')
					->join('blog_categories as blg','blg.nblogcategoryid','=','pst.nblogcategoryid');

			if(trim($posttitle)!=''){
				$data = $data->where(\DB::raw('UPPER(pst.stitle)'), 'like', '%'. mb_strtoupper(trim($posttitle)).'%');
			}

			if(trim($postdescription)!=''){
				$data = $data->where(\DB::raw('UPPER(pst.sdescription)'), 'like', '%'. mb_strtoupper(trim($postdescription)).'%');
			}

			if(trim($blogcategoryid)!='' && $blogcategoryid!=0){
				$data = $data->where(\DB::raw('UPPER(pst.nblogcategoryid)'), '=', $blogcategoryid);
			}

			if(trim($posttag)!=''){
				$data = $data->where(\DB::raw('UPPER(pst.stags)'), 'like', '%'. mb_strtoupper(trim($posttag)).'%');
			}

			if(trim($postuser)!='' && $postuser!=0){
				$data = $data->where(\DB::raw('UPPER(pst.ncreatedby)'), '=', $postuser);
			}

			if(trim($poststatus)!=''){
				$data = $data->where(\DB::raw('UPPER(pst.sstatus)'), '=', $poststatus);
			}
		
			if ($contar){
	
				$data = $data->count();
	
			} else {
	
				$select[] = 'pst.*';
				$select[] = 'blg.sname as blogcategoryname';
				
	
				$data = $data->select($select)
				//->orderByRaw('pst.npostid ASC')
				->offset($pagina)->limit($item_por_pag)
				->get();
			}

	
			return $data;
	
		}
        
        public function getListBlogCategories(){

            $data = BlogCategory::from('blog_categories');
            
            $data = $data->where('sstatus','A');
	
            $select[] = '*';
            
            $data = $data->select($select)
            
            ->get();
	
			return $data;

        }

        public function savePost(Request $request){

            try {
                $post = new Post();
				$post->nblogcategoryid = $request->blogcategoryid;
				$post->stitle = $request->posttitle;
				$post->sdescription = $request->postdescription;
				$post->stags = $request->posttags;
				$post->sauthor = trim((Auth::user()->sname).' '.(Auth::user()->sfatherlastname));
				$post->scontent = $request->postcontent;
				$post->simage1 = $request->postimage1;
				$post->simage2 = $request->postimage2;
				$post->simage3 = $request->postimage3;
				$post->ncreatedby = Auth::user()->nuserid;
				
                $post->saveAsNew();
                //var_dump($post);

                $data['status'] = 'success';
                $data['msg'] = 'La publicación se registró correctamente.';

            } catch (\Exception $ex) {

                $data['status'] = 'error';
                $data['msg'] = 'No se pudo registrar la publicación '.$ex->getMessage();

            }
                
            return response()->json($data);

        }

        public function updatePost(Request $request){
            try {
                $data = \DB::connection('mysql')
                        ->table('posts')
                        ->where('npostid',$request->postid)
						->update(['nblogcategoryid'=>$request->blogcategoryid,
								  'stitle'=>$request->posttitle,
								  'sdescription'=>$request->postdescription,								  
								  'stags'=>$request->posttags,
								  'scontent'=>$request->postcontent,
								  'simage1'=>$request->postimage1,
								  'simage2'=>$request->postimage2,
								  'simage3'=>$request->postimage3,
								  'dmodifiedon'=>@date('Y-m-d H:i:s'),
								  'nmodifiedby'=>Auth::user()->nuserid]);
								  
                $resp['status'] = 'success';
                $resp['msg'] = 'La publicación se actualizó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo actualizar la publicación '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

        public function desactivatePost(Request $request){
            try {
                $data = \DB::connection('mysql')->table('posts')->where('npostid',$request->id)->update(['sstatus'=>'N']);

                $resp['status'] = 'success';
                $resp['msg'] = 'La publicación se desactivó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo desactivar la publicación '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

        public function activatePost(Request $request){
            try {
                $data = \DB::connection('mysql')->table('posts')->where('npostid',$request->id)->update(['sstatus'=>'A']);

                $resp['status'] = 'success';
                $resp['msg'] = 'La publicación se activó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo activar la publicación '.$ex->getMessage();

            }
                
            return response()->json($resp);
		}

		public function highlightPost(Request $request){

			$flag = 'Y';
			$msg = 'La publicación fue destacada.';

			if($request->high == 'Y'){ $flag = 'N'; $msg = 'La publicación fue removida de los destacados.';}


			 try {
                $data = \DB::connection('mysql')->table('posts')->where('npostid',$request->id)->update(['shighlighted'=>$flag]);

                $resp['status'] = 'success';
                $resp['msg'] = $msg;

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo actualizar la publicación '.$ex->getMessage();
            }
            
            return response()->json($resp);
		}

    }
