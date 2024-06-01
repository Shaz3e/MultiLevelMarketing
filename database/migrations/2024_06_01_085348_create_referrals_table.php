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
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            // ID of the user who referred the user who generated the PIN code
            $table->foreignId('referrer_id')->nullable();
            $table->foreign('referrer_id')->references('id')->on('users')->onDelete('set null');
            // ID of the user who used the PIN code
            $table->foreignId('used_by_id')->nullable();
            $table->foreign('used_by_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
