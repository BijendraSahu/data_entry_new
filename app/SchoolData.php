<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SchoolData extends Model
{
//    protected $table = 'tbldata';
    protected $table = 'datasample';
    public $timestamps = false;
    protected $primaryKey = 'ID';


    public function work_by()
    {
        return $this->belongsTo('App\UserMaster', 'WORK_DONE_BY');
    }

    public function lock($value = true)
    {
        $this->lock = $value;
        return $this;
    }

    public function scopelockForUpdate()
    {
        return $this->lock(true);
    }

}
