<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_payout_wallets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('easypaisa_account_title')->nullable();
            $table->string('easypaisa_account_number')->nullable();
            $table->string('jazzcash_account_title')->nullable();
            $table->string('jazzcash_account_number')->nullable();
            $table->string('bank_account_name')->nullable();
            $table->string('bank_account_title')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_payout_wallets');
    }
};
