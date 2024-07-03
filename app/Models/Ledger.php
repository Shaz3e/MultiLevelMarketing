<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ledger extends Model
{
    use HasFactory, SoftDeletes;

    // Ledger Status
    const STATUS_PENDING = "Pending";
    const STATUS_REJECTED = "Rejected";
    const STATUS_HOLD = "Hold";
    const STATUS_PAID = "Paid";

    protected $fillable = [
        'user_id',
        'pin_code',
        'transaction_number',
        'payment_method_id',
        'deposit',
        'withdraw',
        'status',
        'note',
    ];

    protected $dates = ['deleted_at'];

    // Get Invoice Status
    public static function getStatuses()
    {
        return [
            self::STATUS_PENDING,
            self::STATUS_REJECTED,
            self::STATUS_HOLD,
            self::STATUS_PAID,
        ];
    }

    public function setStatus($status)
    {
        if (in_array($status, self::getStatuses())) {
            $this->status = $status;
            $this->save();
        }
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getStatusColor()
    {
        switch ($this->status) {
            case self::STATUS_PENDING:
                return 'bg-info';
            case self::STATUS_REJECTED:
                return 'bg-danger';
            case self::STATUS_HOLD:
                return 'bg-warning';
            case self::STATUS_PAID:
                return 'bg-success';
        }
    }

    public function paymentMethod()
    {
        return $this->belongsTo(paymentMethod::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the PinCode that owns the Ledger.
     */
    public function pinCode()
    {
        return $this->belongsTo(PinCode::class, 'pin_code');
    }
}
