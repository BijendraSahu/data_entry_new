<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolValue extends Model
{
    protected $table = 'tblvalues';
    public $timestamps = false;
    protected  $primaryKey ='VLID';
}
