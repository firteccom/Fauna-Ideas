<?php

	namespace App\Http\Controllers\Admin\Parameter;

	use Illuminate\Http\Request;
	use App\Http\Controllers\Controller;
	use App\Model\Parameter;

	class ParameterController extends Controller {

		private function _view_data($data = array()){
		  $data_view = [];
	
		  return array_merge($data_view, $data);
		}

        public function showView(){

            $request = new Request();

			$data = [];
            
            return view('admin.parameters', $this->_view_data($data));
		}

		public function getParameter(Request $request){

            try {

                $data = Parameter::from('parameters');
                
                $data = $data->where('parameters.nparameterid',$request->nparameterid);
        
                $select[] = 'parameters.*';
                    
                $data = $data->select($select)->first();
    
                $resp['status'] = 'success';
                $resp['msg'] = 'Se obtuvo correctamente el parámetro.';
                $resp['parameter'] = $data;

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se obtuvo el parámetro '.$ex->getMessage();
                $resp['parameter'] = '';
            }

			return response($resp);
		}

		public function getParameters(Request $request){

			$item_por_pag = $request->length;
            $pagina = $request->start;

            $parametername=$request->parametername;
            $parametercode=$request->parametercode;
            $parameterstatus=$request->parameterstatus;
	
			$data = [];
			$data['draw'] = (int)$request->draw;
	
			$data['recordsTotal'] = $this->getParametersFilter($parametername,$parametercode,$parameterstatus,$item_por_pag,$pagina,true);
			$data['recordsFiltered'] = $data['recordsTotal'];
	
			$data['data'] = $this->getParametersFilter($parametername,$parametercode,$parameterstatus,$item_por_pag,$pagina,false);
	
			return response($data);
		}

		public function getParametersFilter($parametername,$parametercode,$parameterstatus,$item_por_pag,$pagina,$contar){

            $data = Parameter::from('parameters');

            if(trim($parametername)!=''){
                $data = $data->where(\DB::raw('UPPER(parameters.sname)'), 'like', '%'. mb_strtoupper(trim($parametername)).'%');
            }

            if(trim($parametercode)!=''){
                $data = $data->where(\DB::raw('UPPER(parameters.scode)'), 'like', '%'. mb_strtoupper(trim($parametercode)).'%');
            }


            if(trim($parameterstatus)!=''){
                $data = $data->where(\DB::raw('UPPER(parameters.sstatus)'), '=', $parameterstatus);
            }
		

			if ($contar){
				$data = $data->count();
			} else {
	
                $select[] = 'parameters.*';

				$data = $data->select($select)
				->offset($pagina)->limit($item_por_pag)
				->get();
			}
	
			return $data;
        }
		
        public function saveParameter(Request $request){

            try {
                $parameter = new Parameter();
                $parameter->sname = $request->parametername;
                $parameter->scode = $request->parametercode;
                $parameter->svalue = $request->parametervalue;
                $parameter->sdescription = $request->parameterdescription;
                $parameter->ncreatedby = 1;

                $parameter->saveAsNew();

                $data['status'] = 'success';
                $data['msg'] = 'El parámetro se registró correctamente.';

            } catch (\Exception $ex) {

                $data['status'] = 'error';
                $data['msg'] = 'No se pudo registrar el parámetro '.$ex->getMessage();

            }
                
            return response()->json($data);
        }

        public function updateParameter(Request $request){
            try {
                $data = \DB::connection('mysql')
                        ->table('parameters')
                        ->where('nparameterid',$request->parameterid)
                        ->update(['sname'=>$request->parametername,
                        			'scode'=>$request->parametercode,
                        			'svalue'=>$request->parametervalue,
                                	'sdescription'=>$request->parameterdescription]);

                $resp['status'] = 'success';
                $resp['msg'] = 'El parámetro se actualizó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo actualizar el parámetro '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

        public function desactivateParameter(Request $request){
            try {
                $data = \DB::connection('mysql')->table('parameters')->where('nparameterid',$request->id)->update(['sstatus'=>'N']);

                $resp['status'] = 'success';
                $resp['msg'] = 'El parámetro se desactivó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo desactivar el parámetro '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

        public function activateParameter(Request $request){
            try {
                $data = \DB::connection('mysql')->table('parameters')->where('nparameterid',$request->id)->update(['sstatus'=>'A']);

                $resp['status'] = 'success';
                $resp['msg'] = 'El parámetro se activó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo activar el parámetro '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

    }
