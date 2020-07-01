<?php

namespace App\Imports;

use App\Model\Category;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToModel;

class CategoryImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Category([
           'sname'  => $row[0],
           'sshortdescription'  => $row[1],
           'sdescription'  => $row[2],
           'sfullimage'  => $row[3],
           'ncategoryparent'  => $row[4],
           'sstatus'  => $row[5],
           'ncreatedby' => Auth::user()->nuserid
        ]);
    }
}
