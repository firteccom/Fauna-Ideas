<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model {

    protected $connection = "mysql";
    protected $table = "slides";
    protected $primaryKey  = 'nslideid';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = ['nslideid', 'nobjecttype', 'nobjectid','smaintext','ssecondarytext','sbuttontext','sfullimage','sstatus','dcreatedon','dmodifiedon','ncreatedby','nmodifiedby'];

	public function saveAsNew(){
		if(!isset($this->nslideid)){
        	$this->save();
		}

		return $this->nslideid;
	}

}

