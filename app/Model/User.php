<?php

	namespace App\Model;

	use Illuminate\Notifications\Notifiable;
	use Illuminate\Foundation\Auth\User as Authenticatable;

	class User extends Authenticatable {

		use Notifiable;

		protected $table = "user";
		protected $primaryKey  = 'id';
		public $timestamps = false;
		public $incrementing = false;

		/*protected $fillable = ['ncodusuario', 'snombre', 'sapellido', 'susuario', 'sclave', 'ncodrol', 'stipologin','sactivo','dfechaultimologin' ,'dfechacreacion', 'ncodusucreacion', 'dfechaedicion', 'ncodusuedicion'];*/

		public function getFullName(){
			$name = $this->name;
			$name = trim($name). ' ' . $this->lastname1. ' ' . $this->lastname2;
			return trim($name);
		}

	}
