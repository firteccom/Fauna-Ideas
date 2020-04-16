<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class File extends Model {

    protected $connection = "mysql";
    protected $table = "files";
    protected $primaryKey  = 'nfileid';
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = ['nfileid', 'ntypeid', 'sname','sshortdescription','sdescription','spath','sstatus','dcreatedon','dmodifiedon','ncreatedby','nmodifiedby'];

	public function saveAsNew(){
		if(!isset($this->nfileid)){
        	$this->save();
		}

		return $this->nfileid;
	}

}