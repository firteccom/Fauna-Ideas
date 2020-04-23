<?php

	namespace App\Http\Controllers\Admin\User;

	use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Hash;
	use App\Http\Controllers\Controller;
	use App\Model\User;

	class UserController extends Controller {

		private function _view_data($data = array()){
		  $data_view = [];
	
		  return array_merge($data_view, $data);
		}

        public function showView(){

            $request = new Request();

			$data = [];
            
            return view('admin.users', $this->_view_data($data));
		}

		public function getUser(Request $request){

            try {
                $data = User::from('user');
                
                $data = $data->where('user.nuserid',$request->nuserid);
        
                $select[] = 'user.*';
                    
                $data = $data->select($select)->first();
    
                $resp['status'] = 'success';
                $resp['msg'] = 'Se obtuvo correctamente el usuario.';
                $resp['user'] = $data;

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se obtuvo el usuario '.$ex->getMessage();
                $resp['user'] = '';
            }

			return response($resp);
		}

		public function getUsers(Request $request){

			$item_por_pag = $request->length;
            $pagina = $request->start;

            $username=$request->username;
            $userfatherlastname=$request->userfatherlastname;
            $usermotherlastname=$request->usermotherlastname;
            $userstatus=$request->userstatus;
	
			$data = [];
			$data['draw'] = (int)$request->draw;
	
			$data['recordsTotal'] = $this->getUsersFilter($username,$userfatherlastname,$usermotherlastname,$userstatus,$item_por_pag,$pagina,true);
			$data['recordsFiltered'] = $data['recordsTotal'];
	
			$data['data'] = $this->getUsersFilter($username,$userfatherlastname,$usermotherlastname,$userstatus,$item_por_pag,$pagina,false);
	
			return response($data);
		}

		public function getUsersFilter($username,$userfatherlastname,$usermotherlastname,$userstatus,$item_por_pag,$pagina,$contar){

            $data = User::from('user');

            if(trim($username)!=''){
                $data = $data->where(\DB::raw('UPPER(user.sname)'), 'like', '%'. mb_strtoupper(trim($username)).'%');
            }

            if(trim($userfatherlastname)!=''){
                $data = $data->where(\DB::raw('UPPER(user.sfatherlastname)'), 'like', '%'. mb_strtoupper(trim($userfatherlastname)).'%');
            }

            if(trim($usermotherlastname)!=''){
                $data = $data->where(\DB::raw('UPPER(user.smotherlastname)'), 'like', '%'. mb_strtoupper(trim($usermotherlastname)).'%');
            }

            if(trim($userstatus)!=''){
                $data = $data->where(\DB::raw('UPPER(user.sstatus)'), '=', $userstatus);
            }
		

			if ($contar){
				$data = $data->count();
			} else {
	
                $select[] = 'user.*';

				$data = $data->select($select)
				->offset($pagina)->limit($item_por_pag)
				->get();
			}
	
			return $data;
        }
		
        public function saveUser(Request $request){

            try {
                $user = new User();
                $user->sname = $request->username;
                $user->sfatherlastname = $request->userfatherlastname;
                $user->smotherlastname = $request->usermotherlastname;
                $user->semail = $request->useremail;
                $user->spassword = Hash::make($request->userpassword);
                $user->dcreatedon = @date('Y-m-d H:i:s');
                $user->ncreatedby = Auth::user()->nuserid;

                $user->saveAsNew();

                $data['status'] = 'success';
                $data['msg'] = 'El usuario se registró correctamente.';

            } catch (\Exception $ex) {

                $data['status'] = 'error';
                $data['msg'] = 'No se pudo registrar el usuario '.$ex->getMessage();

            }
                
            return response()->json($data);
        }

        public function updateUser(Request $request){
            try {
                $data = \DB::connection('mysql')
                        ->table('user')
                        ->where('nuserid',$request->userid)
                        ->update(['sname'=>$request->username,
                        			'sfatherlastname'=>$request->userfatherlastname,
                        			'smotherlastname'=>$request->usermotherlastname,
                                	'semail'=>$request->useremail,
                                    'spassword'=>Hash::make($request->userpassword),
                                    'dmodifiedon'=>@date('Y-m-d H:i:s'),
                                    'nmodifiedby'=>Auth::user()->nuserid]);

                $resp['status'] = 'success';
                $resp['msg'] = 'El usuario se actualizó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo actualizar el usuario '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

        public function desactivateUser(Request $request){
            try {
                $data = \DB::connection('mysql')->table('user')->where('nuserid',$request->id)->update(['sstatus'=>'N','nmodifiedby'=>Auth::user()->nuserid]);

                $resp['status'] = 'success';
                $resp['msg'] = 'El usaurio se desactivó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo desactivar el usuario '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

        public function activateUser(Request $request){
            try {
                $data = \DB::connection('mysql')->table('user')->where('nuserid',$request->id)->update(['sstatus'=>'A','nmodifiedby'=>Auth::user()->nuserid]);

                $resp['status'] = 'success';
                $resp['msg'] = 'El usaurio se activó correctamente.';

            } catch (\Exception $ex) {

                $resp['status'] = 'error';
                $resp['msg'] = 'No se pudo activar el usaurio '.$ex->getMessage();

            }
                
            return response()->json($resp);
        }

    }
