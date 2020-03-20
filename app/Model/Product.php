<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

    protected $connection = "mysql";
    protected $table = "faunaideas.products";
    protected $primaryKey  = 'nproductid';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = ['nproductid', 'sname', 'sdescription','sthumbnail','sfullimage','ncategoryid','nsellerid','scategoryname','nmasterprice','nprice','ssku','sstatus','dcreatedon','dmodifiedon','ncreatedby','nmodifiedby'];

	public function saveAsNew(){
		if(!isset($this->idpersonaltraslado)){
        	$this->save();
		}

		return $this->idpersonaltraslado;
	}

}