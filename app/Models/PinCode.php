<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PinCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'pin',
        'amount',
        'admin_id',
        'user_id',
        'is_used',
    ];    

    // SoftDeletes
    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }
}
