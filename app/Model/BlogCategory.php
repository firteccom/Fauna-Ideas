<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BlogCategory extends Model {

    protected $connection = "mysql";
    protected $table = "blog_categories";
    protected $primaryKey  = 'nblogcategoryid';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = ['nblogcategoryid','nblogcategoryparentid','sname','sshortdescription','sdescription','sfullimage','sstatus','dcreatedon','dmodifiedon','ncreatedby','nmodifiedby'];

	public function saveAsNew(){
		if(!isset($this->nblogcategoryid)){
        	$this->save();
		}

		return $this->nblogcategoryid;
	}

}