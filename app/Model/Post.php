<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    protected $connection = "mysql";
    protected $table = "posts";
    protected $primaryKey  = 'npostid';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = ['npostid','stitle','nblogcategoryid','stags','sauthor','scontent','simage1','simage2','simage3','sstatus','dcreatedon','dmodifiedon','ncreatedby','nmodifiedby'];

	public function saveAsNew(){
		if(!isset($this->npostid)){
        	$this->save();
		}

		return $this->npostid;
	}

}