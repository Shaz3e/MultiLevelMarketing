<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKyc extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_type',
        'user_id',
        'id_number',
        'id_proof_front',
        'id_proof_back',
        'address_proof_type',
        'address_proof',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
