<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

    protected $connection = "mysql";
    protected $table = "categories";
    protected $primaryKey  = 'ncategoryid';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = ['ncategoryid','ncategoryparent','sname','sshortdescription','sdescription','sfullimage','sstatus','dcreatedon','dmodifiedon','ncreatedby','nmodifiedby'];

	public function saveAsNew(){
		if(!isset($this->ncategoryid)){
        	$this->save();
		}

		return $this->ncategoryid;
	}

}