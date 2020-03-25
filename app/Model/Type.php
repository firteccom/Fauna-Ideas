<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Type extends Model {

    protected $connection = "mysql";
    protected $table = "types";
    protected $primaryKey  = 'ntypeid';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = ['ntypeid','ntypeparentid','sname','sdescription','sextension','sstatus','dcreatedon','dmodifiedon','ncreatedby','nmodifiedby'];

	public function saveAsNew(){
		if(!isset($this->ntypeid)){
        	$this->save();
		}

		return $this->ntypeid;
	}

}