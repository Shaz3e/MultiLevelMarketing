<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Auditable as AuditingAuditable;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Authenticatable implements Auditable
{
    use HasFactory, Notifiable, AuditingAuditable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [        
        'company_id',
        'name',
        'email',
        'password',
        'pin_code',
        'phone',
        'address',
        'country',
        'state',
        'city',
        'zip_code',
        'is_email_verified',
        'is_phone_verified',
        'is_kyc_verified',
        'is_active',
        'remember_token',
    ];

    // SoftDeletes
    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Company Relationship
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Support Tickets Relationship
     */
    public function supportTickets()
    {
        return $this->hasMany(SupportTicket::class);
    }

    /**
     * User KYC
     */
    public function userKyc()
    {
        return $this->hasOne(UserKyc::class);
    }

    /**
     * Wallet
     */
    public function wallet()
    {
        return $this->hasOne(UserWallet::class);
    }

    public function pincodes()
    {
        return $this->hasMany(PinCode::class, 'user_id');
    }

    protected function setAuditInclude()
    {
        // Get all columns from the model's table
        $columns = $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());

        // Set the $auditInclude property to include all columns
        $this->auditInclude = $columns;
    }
}
