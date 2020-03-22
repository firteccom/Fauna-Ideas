<?php

	namespace App\Model;

	use Illuminate\Notifications\Notifiable;
	use Illuminate\Foundation\Auth\User as Authenticatable;

	class User extends Authenticatable {

		use Notifiable;

		protected $table = "user";
		protected $primaryKey  = 'nuserid';
		public $timestamps = false;
		public $incrementing = false;

		/*protected $fillable = ['ncodusuario', 'snombre', 'sapellido', 'susuario', 'sclave', 'ncodrol', 'stipologin','sactivo','dfechaultimologin' ,'dfechacreacion', 'ncodusucreacion', 'dfechaedicion', 'ncodusuedicion'];*/

		public function getFullName(){
			$name = $this->sname;
			$name = trim($name). ' ' . $this->sfatherlastname. ' ' . $this->smotherlastname;
			return trim($name);
		}

	}
