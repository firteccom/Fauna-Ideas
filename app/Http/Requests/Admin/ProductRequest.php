<?php

	namespace App\Http\Requests\Admin\Login;

	use Illuminate\Foundation\Http\FormRequest;

	class ProductRequest extends FormRequest {

		public function authorize() {
			return true;
		}

		public function rules() {
			return [
				'email' => 'required|min:5|max:21',
				'password' => 'required|min:3|max:255'
			];
		}

		public function messages(){
			return [
				'email.required'=>'requerido',
				'email.exists'=>'El usuario no existe',
				'email.min'=>'min. :min caracteres',
				'email.max'=>'max. :max caracteres',
				'password.required'=>'requerido',
				'password.min'=>'min. :min caracteres',
				'password.max'=>'max. :max caracteres'
			];
		}

	}
