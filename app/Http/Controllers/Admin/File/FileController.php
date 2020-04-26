<?php

	namespace App\Http\Controllers\Admin\File;

	use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Storage;
	use App\Http\Controllers\Controller;
	use App\Model\Type;
	use App\Model\File;

	class FileController extends Controller {

		private function _view_data($data = array()){
		  $data_view = [];
	
		  return array_merge($data_view, $data);
		}

        public function showView(){

			$types = $this->getListTypes();

			$data = [
				'types' => $types
			];

            return view('admin.files', $this->_view_data($data));
		}
		
		public function getFile(Request $request){

            try {

                $data = File::from('files as fi');
                
                $data = $data->where('fi.nfileid',$request->nfileid);
        
                $select[] = 'fi.*';
                    
                $data = $data->select($select)->first();
    
                $resp['status'] = 'success';
                $resp['msg'] = 'Se obtuvo correctamente el archivo.';
                $resp['file'] = $data;

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se obtuvo el archivo '.$ex->getMessage();
                $resp['file'] = '';
            }
    
            //var_dump($data);

			return response($resp);

		}
		
		public function getFiles(Request $request){


			//$codigousuario = Auth::user()->id;
			$item_por_pag = $request->length;
			$pagina = $request->start;

			$filetype = $request->filetype;
			$filename = $request->filename;
			$fileshortdescription = $request->fileshortdescription;
			$filedescription = $request->filedescription;
			$filestatus = $request->filestatus;
	
			$data = [];

			$data['draw'] = (int)$request->draw;

			$data['recordsTotal'] = $this->getFilesFilter($filename,$filetype,$fileshortdescription,$filedescription,$filestatus,$item_por_pag,$pagina,true);
			$data['recordsFiltered'] = $data['recordsTotal'];
	
			$data['data'] = $this->getFilesFilter($filename,$filetype,$fileshortdescription,$filedescription,$filestatus,$item_por_pag,$pagina,false);
	
			return response($data);

		}

		public function getFilesFilter($filename,$filetype,$fileshortdescription,$filedescription,$filestatus,$item_por_pag,$pagina,$contar){
			$data = File::from('files as fi')
					->join('types as t','t.ntypeid','=','fi.ntypeid');

			if(trim($filename)!=''){
				$data = $data->where(\DB::raw('UPPER(fi.sname)'), 'like', '%'. mb_strtoupper(trim($filename)).'%');
			}

			if(trim($filetype)!='' && $filetype!=0){
				$data = $data->where(\DB::raw('UPPER(fi.nfileid)'), '=', $filetype);
			}

			if(trim($fileshortdescription)!=''){
				$data = $data->where(\DB::raw('UPPER(fi.sshortdescription)'), 'like', '%'. mb_strtoupper(trim($fileshortdescription)).'%');
			}

			if(trim($filedescription)!=''){
				$data = $data->where(\DB::raw('UPPER(fi.sdescription)'), 'like', '%'. mb_strtoupper(trim($filedescription)).'%');
			}

			if(trim($filestatus)!=''){
				$data = $data->where(\DB::raw('UPPER(fi.sstatus)'), '=', $filestatus);
			}
		
			if ($contar){
	
				$data = $data->count();
	
			} else {
	
				$select[] = 'fi.*';
                $select[] = 't.sname as typename';

				$data = $data->select($select)
				//->orderByRaw('fi.nfileid ASC')
				->offset($pagina)->limit($item_por_pag)
				->get();
			}

	
			return $data;
	
		}
        
        public function getListTypes(){

            $data = Type::from('types');
            
            $data = $data->where('sstatus','A');
            $data = $data->where('ntypeparentid',0);
	
            $select[] = '*';
            
            $data = $data->select($select)
                         ->get();
	
			return $data;

        }

        public function saveFile(Request $request){

            try {
                
                $result = [];
                $route = "";

                $archivo = $request->file('fileupload');
                $filetype = $request->filetype;
                $filename = $request->filename;
                $fileshortdescription = $request->fileshortdescription;
                $filedescription = $request->filedescription;

                //echo $filetype;
                
                $ext = mb_strtolower($archivo->getClientOriginalExtension());

                //Validate if files are images
                if (in_array($ext, ['jpg','gif','png','jpeg'])){
                    $route = "images";
                    $name = "img";
                //Validate if files are images
                } else if (in_array($ext, ['3gp','mov','mp4','avi','mpeg','mpg','m4v'])){
                    $route = "videos";
                    $name = "video";
                //Validate if files are images
                } else if (in_array($ext, ['mp3','wav','ogg','midi','mid','wma'])){
                    $route = "audios";
                    $name = "audio";
                //Validate if files are another files
                } else {
                    $route = "files";
                    $name = "file";
                }

                $finalname = $name.'_'.uniqid().'.'.$ext;

                if(isset($archivo)){
                    if($archivo->storeAs('',$finalname,$route)){

                        $file = new File();
                        $file->ntypeid = $filetype;
                        $file->sname = $filename;
                        $file->sshortdescription = $fileshortdescription;
                        $file->sdescription = $filedescription;
                        $file->spath = $route."/".$finalname;
                        $file->dcreatedon = @date('Y-m-d H:i:s');
				        $file->ncreatedby = Auth::user()->nuserid;

                        //echo "Tipo ID: ".$filetype;
                        
                        $file->saveAsNew();

                        $data['status'] = 'success';
                        $data['msg'] = 'El archivo se registró correctamente';

                    }else{
                        $data['status'] = 'error';
                        $data['msg'] = 'No se pudo guardar el archivo';
                    }
                } else{
                    $data['status'] = 'error';
                    $data['msg'] = 'No se detectó archivo';
                }
                
                //var_dump($file);

            } catch (\Exception $ex) {

                $data['status'] = 'error';
                $data['msg'] = 'No se pudo registrar el archivo '.$ex->getMessage();

            }
                
            return response()->json($data);

        }

        public function updateFile(Request $request){
            try {
                $data = \DB::connection('mysql')
                        ->table('files')
                        ->where('nfileid',$request->fileid)
						->update(['ntypeid'=>$request->filetype,
								  'sname'=>$request->sname,
								  'sshortdescription'=>$request->sshortdescription,
								  'sdescription'=>$request->sdescription,
								  'spath'=>$request->spath,
                                  'dmodifiedon'=>@date('Y-m-d H:i:s'),
                                  'nmodifiedby'=>Auth::user()->nuserid]);
								  
                $resp['status'] = 'success';
                $resp['msg'] = 'El archivo se actualizó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo actualizar el archivo '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

        public function desactivateFile(Request $request){
            try {
                $data = \DB::connection('mysql')->table('files')->where('nfileid',$request->id)->update(['sstatus'=>'N','nmodifiedby'=>Auth::user()->nuserid]);

                $resp['status'] = 'success';
                $resp['msg'] = 'El archivo se desactivó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo desactivar el archivo '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

        public function activateFile(Request $request){
            try {
                $data = \DB::connection('mysql')->table('files')->where('nfileid',$request->id)->update(['sstatus'=>'A','nmodifiedby'=>Auth::user()->nuserid]);

                $resp['status'] = 'success';
                $resp['msg'] = 'El archivo se activó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo activar el archivo '.$ex->getMessage();

            }
                
            return response()->json($resp);
		}

		public function highlightFile(Request $request){

			$flag = 'Y';
			$msg = 'El archivo fue destacado.';

			if($request->high == 'Y'){ $flag = 'N'; $msg = 'El archivo fue quitado de los destacados.';}


			 try {
                $data = \DB::connection('mysql')->table('files')->where('nfileid',$request->id)->update(['shighlighted'=>$flag,'nmodifiedby'=>Auth::user()->nuserid]);

                $resp['status'] = 'success';
                $resp['msg'] = $msg;

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo modificar el archivo '.$ex->getMessage();
            }
            
            return response()->json($resp);
		}

    }
