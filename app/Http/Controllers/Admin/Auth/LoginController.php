<?php

	namespace App\Http\Controllers\Admin\Auth;

	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Hash;
	use App\Http\Controllers\Controller;
	use App\Http\Requests\Admin\Login\LoginRequest;
	use App\Model\User;


	class LoginController extends Controller {

		public function form() {
			return view('admin.login.app');
		}

		public function login(LoginRequest $request) {
			$user = User::where(['semail' => mb_strtoupper($request->semail)])->where('sstatus','A')->first();
			$data = [];

			if ($user):

				$passexists = Hash::check($request->spassword, $user->spassword);

				if($passexists):

					Auth::guard('admin')->loginUsingId($user->nuserid);
					$message = 'Login exitoso';
					$array = (object)['request' => $request, 'array' => ['resp' => true, 'message' => $message, 'url' => route('admin.product.form'), 'errors' => null], 'status' => 200, 'route' => route('admin.product.form'), 'message' => null, 'type' => 'success'];
					$data = $this->optimize($array);


				else:
					$message = 'Contraseña incorrecta';
					$array = (object)['request' => $request, 'array' => ['resp' => false, 'message' => $message, 'errors' => ['usuario' => 'Su contraseña es incorrecta']], 'status' => 422, 'route' => route('admin.login'), 'message' => $message, 'type' => 'improper'];
					$data = $this->optimize($array);
				endif;


			else:
				$message = 'El usuario no existe';
				$array = (object)['request' => $request, 'array' => ['resp' => false, 'message' => $message, 'errors' => ['usuario' => 'Su cuenta no existe']], 'status' => 422, 'route' => route('admin.login'), 'message' => $message, 'type' => 'improper'];
				$data = $this->optimize($array);
			endif;
			return $data;

		}


		public function error(){
			$message = 'Debe iniciar sesión';
			$array = (object)['array' => ['request' => null,'resp' => false, 'message' => $message, 'errors' => null], 'status' => 422, 'route' => route('admin.login'), 'message' => $message, 'type' => 'improper'];
			$data = $this->optimize($array);
			return $data;
		}

		public function destroy(Request $request) {
			Auth::guard('admin')->logout();
			$message = 'Sesión cerrada exitosamente';
			$array = (object)['request' => $request, 'array' => ['resp' => true, 'message' => $message, 'errors' => null], 'status' => 200, 'route' => route('admin.login'), 'message' => $message, 'type' => 'success'];
			$data = $this->optimize($array);
			return $data;
		}


		private function optimize($array) {
			session()->flash($array->type, $array->message);
			if ($array->request->ajax()):
				$data = response()->json($array->array, $array->status);
			else:
				$data = redirect($array->route);
			endif;
			return $data;
		}

	}