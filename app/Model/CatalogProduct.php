<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CatalogProduct extends Model {

    protected $connection = "mysql";
    protected $table = "catalog_product";
    protected $primaryKey  = 'ncatalogproductid';
    public $timestamps = false;
    public $incrementing = false;



    protected $fillable = ['ncatalogproductid','ncatalogid','nproductid','sstatus','dcreatedon','dmodifiedon','ncreatedby','nmodifiedby'];

	public function saveAsNew(){
		if(!isset($this->ncatalogproductid)){
        	$this->save();
		}

		return $this->ncatalogproductid;
	}

}