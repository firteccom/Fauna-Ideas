<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model {

    protected $connection = "mysql";
    protected $table = "catalog";
    protected $primaryKey  = 'ncatalogid';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = ['ncatalogid','sname','sdescription','sfullimage','sstatus','dcreatedon','dmodifiedon','ncreatedby','nmodifiedby'];

	public function saveAsNew(){
		if(!isset($this->ncatalogid)){
        	$this->save();
		}

		return $this->ncatalogid;
	}

}