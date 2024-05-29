<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PinCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $filalble = [
        'pin',
        'amount',
        'customer_id',
        'user_id',
        'is_used',
    ];

    protected $dates = ['deleted_at'];
}
