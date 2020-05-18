<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'order_ref', 'create_by',
    ];

    protected $primaryKey = 'order_id';
}
