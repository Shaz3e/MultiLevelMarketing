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
            $table->integer('parent_id')->nullable()->constrained();
            $table->foreignId('user_id')->constrained();
            $table->integer('level_1')->nullable()->constrained();
            $table->integer('level_2')->nullable()->constrained();
            $table->integer('level_3')->nullable()->constrained();
            $table->integer('level_4')->nullable()->constrained();
            
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
