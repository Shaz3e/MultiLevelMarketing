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
        Schema::create('referral_trees', function (Blueprint $table) {
            $table->id();
            // ID of the user who referred the user
            $table->foreignId('referrer_id')->nullable();
            $table->foreign('referrer_id')->references('id')->on('users')->onDelete('set null');
            // ID of the user who used referral
            $table->foreignId('direct_id')->nullable();
            $table->foreign('direct_id')->references('id')->on('users')->onDelete('set null');
            $table->foreignId('level_1')->nullable();
            $table->foreign('level_1')->references('id')->on('users')->onDelete('set null');
            $table->foreignId('level_2')->nullable();
            $table->foreign('level_2')->references('id')->on('users')->onDelete('set null');
            $table->foreignId('level_3')->nullable();
            $table->foreign('level_3')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referral_trees');
    }
};
