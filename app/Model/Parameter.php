<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Parameter extends Model {

    protected $connection = "mysql";
    protected $table = "parameters";
    protected $primaryKey  = 'nparameterid';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = ['nparameterid','sname','scode','svalue','sdescription','sstatus','dcreatedon','dmodifiedon','ncreatedby','nmodifiedby'];

	public function saveAsNew(){
		if(!isset($this->nparameterid)){
        	$this->save();
		}

		return $this->nparameterid;
	}

}