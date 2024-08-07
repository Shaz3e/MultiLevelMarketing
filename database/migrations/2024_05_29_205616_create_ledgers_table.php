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
        Schema::create('ledgers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('pin_code')->nullable()->unique();
            $table->foreign('pin_code')->references('id')->on('pin_codes')->onDelete('cascade');
            $table->string('transaction_number')->unique();
            $table->foreignId('payment_method_id')->nullable();
            $table->foreign('payment_method_id')->references('id')->on('payment_methods')->onDelete('cascade');
            $table->decimal('deposit', 10, 2)->default(0.00)->nullable();
            $table->decimal('withdraw', 10, 2)->default(0.00)->nullable();
            $table->string('status')->default('Pending');
            $table->string('note')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ledgers');
    }
};
