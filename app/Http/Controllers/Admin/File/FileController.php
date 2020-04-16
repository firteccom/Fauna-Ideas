<?php

	namespace App\Http\Controllers\Admin\File;

	use Illuminate\Http\Request;
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
	
            $select[] = '*';
            
            $data = $data->select($select)
                         ->get();
	
			return $data;

        }

        public function saveFile(Request $request){

            try {
                
                $result = [];

                /*$tipo = $request->tipoanexo;
                $descripcion = $request->anexodesc;
                $publico = $request->anexopublico;*/

                //echo "Pruebaaaaa";

                $archivo = $request->file('fileupload');
                $ext = mb_strtolower($archivo->getClientOriginalExtension());
                
                if ($archivo != null) {
                    echo $ext;
                }

                $nombre = $ext.'_'.uniqid();

                if(isset($archivo)){
                    if(in_array($ext, ['doc','docx','xls','xlsx','ppt', 'pptx', 'pdf'])){
                        if($archivo->storeAs('',$nombre.'.'.$ext,'files')){
                            $result['status'] = 'success';
                            $result['msg'] = 'Archivo agregado';
                            $result['anexo'] = [
                            'repositorio'=>'',
                            'archivo'=>$nombre.'.'.$ext,
                            'id'=>'0'
                            ];
                        }else{
                            $result['status'] = 'error';
                            $result['msg'] = 'No se pudo guardar el archivo';
                        }
                    } else{
                        $result['status'] = 'error';
                        $result['msg'] = 'Sólo se permiten doc, docx, xls, xlsx, ppt, pptx, pdf';
                    }
                } else{
                    $result['status'] = 'error';
                    $result['msg'] = 'No se detectó archivo';
                }

                /*$file = new File();
				$file->ntypeid = $request->filetype;
				$file->sname = $request->sname;
				$file->sshortdescription = $request->sshortdescription;
				$file->sdescription = $request->sdescription;
				$file->ncreatedby = 1;
				
                $file->saveAsNew();*/
                //var_dump($file);

                /*$data['status'] = 'success';
                $data['msg'] = 'El archivo se registró correctamente.';*/

            } catch (\Exception $ex) {

                $result['status'] = 'error';
                $result['msg'] = 'No se pudo registrar el archivo '.$ex->getMessage();

            }
                
            return response()->json($result);

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
								  'spath'=>$request->spath]);
								  
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
                $data = \DB::connection('mysql')->table('files')->where('nfileid',$request->id)->update(['sstatus'=>'N']);

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
                $data = \DB::connection('mysql')->table('files')->where('nfileid',$request->id)->update(['sstatus'=>'A']);

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
                $data = \DB::connection('mysql')->table('files')->where('nfileid',$request->id)->update(['shighlighted'=>$flag]);

                $resp['status'] = 'success';
                $resp['msg'] = $msg;

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo modificar el archivo '.$ex->getMessage();
            }
            
            return response()->json($resp);
		}

    }
