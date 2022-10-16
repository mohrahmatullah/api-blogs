<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';

    public function transaction()
    {
        return $this->belongsTo('App\Models\Transaction','payment_id');
    }
}
