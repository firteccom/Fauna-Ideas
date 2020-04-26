<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostComment extends Model {

    protected $connection = "mysql";
    protected $table = "post_comments";
    protected $primaryKey  = 'nposcommenttid';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = ['nposcommenttid','npostid','sname','semail','smobile','scomment','smac','saddresspublic','sreviewstatus','sstatus','dcreatedon','dmodifiedon','ncreatedby','nmodifiedby'];

	public function saveAsNew(){
		if(!isset($this->nposcommenttid)){
        	$this->save();
		}

		return $this->nposcommenttid;
	}

}