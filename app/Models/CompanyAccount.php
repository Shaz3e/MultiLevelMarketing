<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyAccount extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'starting_balance',
        'total_in',
        'total_out',
        'last_deposit',
        'last_withdraw',
        'last_deposit_date',
        'last_withdraw_date',
    ];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'last_deposit_date' => 'datetime:Y-m-d H:i:s',
        'last_withdraw_date' => 'datetime:Y-m-d H:i:s',
    ];
}
