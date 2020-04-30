<?php

	namespace App\Http\Requests\Admin\Login;

	use Illuminate\Foundation\Http\FormRequest;

	class LoginRequest extends FormRequest {

		public function authorize() {
			return true;
		}

		public function rules() {
			return [
				'semail' => 'required|min:5',
				'spassword' => 'required|min:3|max:255'
			];
		}

		public function messages(){
			return [
				'semail.required'=>'requerido',
				'semail.exists'=>'El usuario no existe',
				'semail.min'=>'min. :min caracteres',
				'semail.max'=>'max. :max caracteres',
				'spassword.required'=>'requerido',
				'spassword.min'=>'min. :min caracteres',
				'spassword.max'=>'max. :max caracteres'
			];
		}

	}
