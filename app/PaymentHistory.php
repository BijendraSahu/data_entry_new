<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentHistory extends Model
{
    protected $table = 'payment_history';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\UserMaster', 'user_id');
    }
}
