<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PinCode extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'pin_code',
        'amount',
        'admin_id',
        'user_id',
        'is_used',
    ];    

    // SoftDeletes
    protected $dates = ['deleted_at'];

    protected $casts = [
        'used_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function usedBy()
    {
        return $this->belongsTo(User::class, 'used_by');
    }
}
