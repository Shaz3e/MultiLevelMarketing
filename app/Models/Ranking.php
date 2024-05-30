<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ranking extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'icon',
        'level',
        'name',
        'reward',
        'reward_image',
        'bonus_point',
        'is_active',
    ];    

    // SoftDeletes
    protected $dates = ['deleted_at'];

}
