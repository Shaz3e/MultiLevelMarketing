<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralTree extends Model
{
    use HasFactory;

    protected $fillable = [
        'referrer_id',
        'direct_id',
        'level_1',
        'level_2',
        'level_3',
    ];
}
