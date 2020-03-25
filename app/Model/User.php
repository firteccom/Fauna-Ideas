<?php

	namespace App\Model;

	use Illuminate\Notifications\Notifiable;
	use Illuminate\Foundation\Auth\User as Authenticatable;

	class User extends Authenticatable {

		use Notifiable;

		protected $connection = "mysql";
		protected $table = "user";
		protected $primaryKey  = 'nuserid';
		public $timestamps = false;
		public $incrementing = false;

		protected $fillable = ['nuserid', 'sname', 'sfatherlastname', 'smotherlastname', 'semail', 'spassword','sstatus','dcreatedon','dmodifiedon','ncreatedby','nmodifiedby'];

		public function getFullName(){
			$name = $this->sname;
			$name = trim($name). ' ' . $this->sfatherlastname. ' ' . $this->smotherlastname;
			return trim($name);
		}

		public function saveAsNew(){
			if(!isset($this->nuserid)){
	        	$this->save();
			}

			return $this->nuserid;
		}

	}