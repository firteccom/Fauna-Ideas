<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model {

    protected $connection = "mysql";
    protected $table = "product_attribute";
    protected $primaryKey  = 'nproductattributeid';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = ['nproductattributeid', 'nproductid', 'sname', 'svalue','ntypeid','stypename','sflagdescriptive','sstatus','dcreatedon','dmodifiedon','ncreatedby','nmodifiedby'];

	public function saveAsNew(){
		if(!isset($this->nproductattributeid)){
        	$this->save();
		}

		return $this->nproductattributeid;
	}

}