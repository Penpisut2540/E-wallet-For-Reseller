<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Historycredit extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'history_credit';

    protected $fillable = [
        'topup', 'pay', 'create_by', 'typeCreate', 'credit_id', 'change',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];
    protected $primaryKey = 'hiscredit_id';
}
