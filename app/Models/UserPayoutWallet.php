<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPayoutWallet extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'easypaisa_account_title',
        'easypaisa_account_number',
        'jazzcash_account_title',
        'jazzcash_account_number',
        'bank_account_name',
        'bank_account_title',
        'bank_account_number'
    ];

    public function bankList()
    {
        return [
            "Al Baraka Bank Pakistan Limited" => "Al Baraka Bank Pakistan Limited",
            "Alfalah Bank Limited" => "Alfalah Bank Limited",
            "Allied Bank Limited" => "Allied Bank Limited",
            "Askari Bank Limited" => "Askari Bank Limited",
            "Bank AL Habib Limited" => "Bank AL Habib Limited",
            "BankIslami Pakistan Limited" => "BankIslami Pakistan Limited",
            "Burj Bank Limited" => "Burj Bank Limited",
            "Deutsche Bank" => "Deutsche Bank",
            "Dubai Islamic Bank Pakistan Limited" => "Dubai Islamic Bank Pakistan Limited",
            "Faysal Bank Limited" => "Faysal Bank Limited",
            "First Women Bank Limited" => "First Women Bank Limited",
            "Habib Bank Limited" => "Habib Bank Limited",
            "Habib Metropolitan Bank Limited" => "Habib Metropolitan Bank Limited",
            "Industrial And Commercial Bank Of Chaina" => "Industrial And Commercial Bank Of Chaina",
            "JS Bank Limited" => "JS Bank Limited",
            "MCB Bank Limited" => "MCB Bank Limited",
            "MCB Islamic Bank Limited" => "MCB Islamic Bank Limited",
            "Meezan Bank Limited" => "Meezan Bank Limited",
            "National Bank Of Pakistan" => "National Bank Of Pakistan",
            "NIB Bank Limited" => "NIB Bank Limited",
            "S.M.E. Bank Limited" => "S.M.E. Bank Limited",
            "Samba Bank Limited" => "Samba Bank Limited",
            "Silk Bank Limited" => "Silk Bank Limited",
            "Sindh Bank Limited" => "Sindh Bank Limited",
            "Soneri Bank Limited" => "Soneri Bank Limited",
            "Standard Chartered Bank Pakistan Limited" => "Standard Chartered Bank Pakistan Limited",
            "Summit Bank Limited" => "Summit Bank Limited",
            "The Bank Of Khyber" => "The Bank Of Khyber",
            "The Bank Of Punjab" => "The Bank Of Punjab",
            "The Punjab Provincial Cooperative Bank Limited" => "The Punjab Provincial Cooperative Bank Limited",
            "Ubl Bank Limited" => "Ubl Bank Limited",
            "Zarai Taraqiati Bank Limited" => "Zarai Taraqiati Bank Limited",
            "NayaPay" => "NayaPay",
            "SadaPay" => "SadaPay",
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
