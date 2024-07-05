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
        Schema::create('company_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->decimal('starting_balance', 12, 2)->default(0.00);
            $table->decimal('total_in', 12, 2)->default(0.00);
            $table->decimal('total_out', 12, 2)->default(0.00);
            $table->decimal('last_deposit', 12, 2)->default(0.00);
            $table->decimal('last_withdraw', 12, 2)->default(0.00);
            $table->dateTime('last_deposit_date')->nullable();
            $table->dateTime('last_withdraw_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('company_accounts');
    }
};
