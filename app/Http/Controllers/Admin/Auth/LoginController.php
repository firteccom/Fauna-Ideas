<?php

	namespace App\Http\Controllers\Admin\Auth;

	use App\Http\Controllers\Controller;
	use App\Http\Requests\Admin\Login\LoginRequest;
	use App\Model\User;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Hash;


	class LoginController extends Controller {

		public function form() {
			return view('admin.login.app');
		}

		public function login(LoginRequest $request) {
			$user = User::where(['email' => mb_strtoupper($request->email)])->where('enabled','Y')->first();
			$data = [];

			if ($user):

				//$passexists = Hash::check($request->password, $user->password);

				$passexists = $request->password == $user->password;

				if($passexists):

					Auth::guard('admin')->loginUsingId($user->id);
					$message = 'Login exitoso';
					$array = (object)['request' => $request, 'array' => ['resp' => true, 'message' => $message, 'url' => route('admin.panel.index'), 'errors' => null], 'status' => 200, 'route' => route('admin.panel.index'), 'message' => null, 'type' => 'success'];
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