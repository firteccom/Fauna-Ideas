<?php

	namespace App\Http\Controllers\Admin\PostComment;

	use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
	use App\Http\Controllers\Controller;
	use App\Model\User;
	use App\Model\BlogCategory;
	use App\Model\Post;	
	use App\Model\PostComment;


	class PostCommentController extends Controller {

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
            
            return view('admin.post_comments', $this->_view_data($data));
		}
		
		public function getComment(Request $request){

            try {

                $data = PostComment::from('post_comments as blogpostcomment');
                
                $data = $data->where('blogpostcomment.npostcommentid',$request->npostcommentid);
        
                $select[] = 'blogpostcomment.*';
                    
                $data = $data->select($select)->first();
    
                $resp['status'] = 'success';
                $resp['msg'] = 'Se obtuvo correctamente el comentario de la publicación.';
                $resp['blogcategory'] = $data;

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se obtuvo el comentario de la publicación '.$ex->getMessage();
                $resp['blogcategory'] = '';
            }

			return response($resp);

		}
		
		public function getPostComments(Request $request){

			//$codigousuario = Auth::user()->id;
			$item_por_pag = $request->length;
            $pagina = $request->start;

            $postcategory=$request->postcategory;
            $post=$request->post;
            $commentname=$request->commentname;
            $commentemail=$request->commentemail;
            $commentmobile=$request->commentmobile;
            $commentreviewstatus=$request->commentreviewstatus;
            $commentstatus=$request->commentstatus;
	
			$data = [];
			$data['draw'] = (int)$request->draw;
	
			$data['recordsTotal'] = $this->getPostCommentsFilter($postcategory,$post,$commentname,$commentemail,$commentmobile,$commentreviewstatus,$commentstatus,$item_por_pag,$pagina,true);
			$data['recordsFiltered'] = $data['recordsTotal'];
	
			$data['data'] = $this->getPostCommentsFilter($postcategory,$post,$commentname,$commentemail,$commentmobile,$commentreviewstatus,$commentstatus,$item_por_pag,$pagina,false);
	
			return response($data);

		}

		public function getPostCommentsFilter($postcategory,$post,$commentname,$commentemail,$commentmobile,$commentreviewstatus,$commentstatus,$item_por_pag,$pagina,$contar){

            $data = PostComment::from('post_comments as postcomment')
                    ->join('posts as pst','pst.npostid','=','postcomment.npostid')
                    ->join('blog_categories as blg','blg.nblogcategoryid','=','pst.nblogcategoryid');


            //var_dump($blogcategoryname);

			if(trim($postcategory)!='' && $postcategory!=0){
				$data = $data->where(\DB::raw('blg.nblogcategoryid'), '=', $postcategory);
			}

			if(trim($post)!='' && $post!=0){
				$data = $data->where(\DB::raw('pst.npostid'), '=', $post);
			}

            if(trim($commentname)!=''){
                $data = $data->where(\DB::raw('UPPER(postcomment.sname)'), 'like', '%'. mb_strtoupper(trim($commentname)).'%');
            }

            if(trim($commentemail)!=''){
                $data = $data->where(\DB::raw('UPPER(postcomment.semail)'), 'like', '%'. mb_strtoupper(trim($commentemail)).'%');
            }

            if(trim($commentmobile)!=''){
                $data = $data->where(\DB::raw('UPPER(postcomment.smobile)'), 'like', '%'. mb_strtoupper(trim($commentmobile)).'%');
            }

            if(trim($commentreviewstatus)!=''){
                $data = $data->where(\DB::raw('UPPER(postcomment.sreviewstatus)'), '=', $commentreviewstatus);
            }

            if(trim($commentstatus)!=''){
                $data = $data->where(\DB::raw('UPPER(postcomment.sstatus)'), '=', $commentstatus);
            }
		
			if ($contar){
	
				$data = $data->count();
	
			} else {
	
                $select[] = 'postcomment.*';
				$select[] = \DB::raw('CONCAT(SUBSTRING(postcomment.scomment, 1, 30),"...") AS sshortcomment');
                $select[] = 'blg.sname as postcategoryname';
                $select[] = 'pst.stitle as posttitle';

                
					
				$data = $data->select($select)
				//->orderByRaw('prd.nproductid ASC')
				->offset($pagina)->limit($item_por_pag)
				->get();
			}
	
			return $data;
	
        }
        
        public function getListBlogCategories(Request $request){

            $data = PostComment::from('blog_categories');

            if ($request->id != null){
            
                $data = $data->where('nblogcategoryid','<>',$request->id);

            }
	
            $select[] = '*';
            
            $data = $data->select($select)
            
            ->get();
	
			return $data;

        }

        public function activatePostComment(Request $request){
            try {
                $data = \DB::connection('mysql')->table('post_comments')->where('npostcommentid',$request->id)->update(['sstatus'=>'A','nmodifiedby'=>Auth::user()->nuserid]);

                $resp['status'] = 'success';
                $resp['msg'] = 'El comentario de la publicación se activó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo activar el comentario de la publicación '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

        public function desactivatePostComment(Request $request){
            try {
                $data = \DB::connection('mysql')->table('post_comments')->where('npostcommentid',$request->id)->update(['sstatus'=>'N','nmodifiedby'=>Auth::user()->nuserid]);

                $resp['status'] = 'success';
                $resp['msg'] = 'El comentario de la publicación se desactivó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo desactivar el comentario de la publicación '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

        public function approvePostComment(Request $request){
            try {
                $data = \DB::connection('mysql')->table('post_comments')->where('npostcommentid',$request->id)->update(['sreviewstatus'=>'A','nmodifiedby'=>Auth::user()->nuserid]);

                $resp['status'] = 'success';
                $resp['msg'] = 'El comentario de la publicación se aprobó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo aprobar el comentario de la publicación '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

        public function rejectPostComment(Request $request){

            try {
                $data = \DB::connection('mysql')->table('post_comments')->where('npostcommentid',$request->id)->update(['sreviewstatus'=>'R','nmodifiedby'=>Auth::user()->nuserid]);

                $resp['status'] = 'success';
                $resp['msg'] = 'El comentario de la publicación se rechazó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo rechazar el comentario de la publicación '.$ex->getMessage();

            }
                
            return response()->json($resp);

        }
        
        public function getListPosts(Request $request){

            $data = Post::from('posts');

            if ($request->id != null){
            
                $data = $data->where('nblogcategoryid','=',$request->id);

            }
	
            $select[] = '*';
            
            $data = $data->select($select)->get();
	
			return $data;

        }

    }
