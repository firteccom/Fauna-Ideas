<?php

	namespace App\Http\Controllers\Admin\Type;

	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use App\Model\User;
	use App\Model\Type;	


	class TypeController extends Controller {

		private function _view_data($data = array()){
		  $data_view = [];
	
		  return array_merge($data_view, $data);
		}

        public function showView(){

            $request = new Request();

            $types = $this->getListTypes($request);

			$data = [
				'types' => $types
            ];
            
            return view('admin.types', $this->_view_data($data));
		}
		
		public function getType(Request $request){

            try {

                $data = Type::from('types');
                
                $data = $data->where('ntypeid',$request->ntypeid);
        
                $select[] = '*';
                    
                $data = $data->select($select)->first();
    
                $resp['status'] = 'success';
                $resp['msg'] = 'Se obtuvo correctamente el tipo.';
                $resp['type'] = $data;

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se obtuvo el tipo '.$ex->getMessage();
                $resp['type'] = '';
            }
    
            //var_dump($data);

			return response($resp);

		}
		
		public function getTypes(Request $request){

			//$codigousuario = Auth::user()->id;
			$item_por_pag = $request->length;
            $pagina = $request->start;

            $typename=$request->typename;
            $typedescription=$request->typedescription;
            $typeextension=$request->typeextension;
            $typestatus=$request->typestatus;

            
			$data = [];
			$data['draw'] = (int)$request->draw;
	
			$data['recordsTotal'] = $this->getTypesFilter($typename,$typedescription,$typeextension,$typestatus,$item_por_pag,$pagina,true);
			$data['recordsFiltered'] = $data['recordsTotal'];
	
			$data['data'] = $this->getTypesFilter($typename,$typedescription,$typeextension,$typestatus,$item_por_pag,$pagina,false);
	
			return response($data);

		}

		public function getTypesFilter($typename,$typedescription,$typeextension,$typestatus,$item_por_pag,$pagina,$contar){

            $data = Type::from('types as typeone')
                    ->leftJoin('types as typetwo','typeone.ntypeparentid','=','typetwo.ntypeid');

            //var_dump($typename);

            if(trim($typename)!=''){
                $data = $data->where(\DB::raw('UPPER(typeone.sname)'), 'like', '%'. mb_strtoupper(trim($typename)).'%');
            }

            if(trim($typeextension)!=''){
                $data = $data->where(\DB::raw('UPPER(typeone.sextension)'), 'like', '%'. mb_strtoupper(trim($typeextension)).'%');
            }

            if(trim($typedescription)!=''){
                $data = $data->where(\DB::raw('UPPER(typeone.sdescription)'), 'like', '%'. mb_strtoupper(trim($typedescription)).'%');
            }

            if(trim($typestatus)!=''){
                $data = $data->where(\DB::raw('UPPER(typeone.sstatus)'), '=', $typestatus);
            }
		
			if ($contar){
	
				$data = $data->count();
	
			} else {
	
                $select[] = 'typeone.*';
                $select[] = 'typetwo.sname as typeparent';

                
					
				$data = $data->select($select)
				->orderByRaw('typeone.ntypeparentid, typeone.sname ASC')
				->offset($pagina)->limit($item_por_pag)
				->get();
			}
	
			return $data;
	
        }
        
        public function getListTypes(Request $request){

            $data = Type::from('types');
            
            //$data = $data->where('sstatus','A');

            //var_dump($request->id);

            if ($request->id != null){
            
                $data = $data->where('ntypeid','<>',$request->id);

            }
	
            $select[] = '*';
            
            $data = $data->select($select)
            
            ->get();
	
			return $data;

        }

        public function saveType(Request $request){

            try {
                $type = new Type();
                $type->ntypeparentid = $request->typeparent;
                $type->sname = $request->typename;
                $type->sextension = $request->typeextension;
                $type->sdescription = $request->typedescription;
				$type->ncreatedby = Auth::user()->nuserid;

                $type->saveAsNew();
                //var_dump($type);

                $data['status'] = 'success';
                $data['msg'] = 'El tipo de valor se registró correctamente.';

            } catch (\Exception $ex) {

                $data['status'] = 'error';
                $data['msg'] = 'No se pudo registrar el tipo de valor '.$ex->getMessage();

            }
                
            return response()->json($data);

        }

        public function updateType(Request $request){
            try {
                $data = \DB::connection('mysql')
                        ->table('types')
                        ->where('ntypeid',$request->typeid)
                        ->update(['ntypeparentid'=>$request->typeparent,
                                  'sname'=>$request->typename,
                                  'sextension'=>$request->typeextension,
                                  'sdescription'=>$request->typedescription,
                                  'dmodifiedon'=>@date('Y-m-d H:i:s'),
                                  'nmodifiedby'=>Auth::user()->nuserid]);

                $resp['status'] = 'success';
                $resp['msg'] = 'El tipo de valor se actualizó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo actualizar el tipo de valor '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

        public function desactivateType(Request $request){
            try {
                $data = \DB::connection('mysql')->table('types')->where('ntypeid',$request->id)->update(['sstatus'=>'N','nmodifiedby'=>Auth::user()->nuserid]);

                $resp['status'] = 'success';
                $resp['msg'] = 'El tipo de valor se desactivó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo desactivar el tipo de valor '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

        public function activateType(Request $request){
            try {
                $data = \DB::connection('mysql')->table('types')->where('ntypeid',$request->id)->update(['sstatus'=>'A','nmodifiedby'=>Auth::user()->nuserid]);

                $resp['status'] = 'success';
                $resp['msg'] = 'El tipo de valor se activó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo activar el tipo de valor '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

    }
