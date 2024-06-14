<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralTree extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'direct_id',
        'level_1',
        'level_2',
        'level_3',
    ];

    /**
     * The user who is referred
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The user who referred
     */
    public function parent()
    {
        return $this->belongsTo(User::class, 'parent_id');
    }

    /**
     * Get Users of the parent
     */
    public function levelOne()
    {
        return $this->hasMany(User::class, 'level_1');
    }
    public function levelTwo()
    {
        return $this->hasMany(User::class, 'level_2');
    }
    public function levelThree()
    {
        return $this->hasMany(User::class, 'level_3');
    }
}
