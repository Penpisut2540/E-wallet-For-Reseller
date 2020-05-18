<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Creditorder extends Model
{
    protected $table = 'credit_order';

    protected $fillable = [
        'credit_id', 'order_id',
    ];

    //protected $primaryKey = 'order_id';
}
