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
        Schema::create('rankings', function (Blueprint $table) {
            $table->id();
            $table->string('icon')->nullable();
            $table->integer('level')->unique()->nullable();
            $table->string('name')->unique()->nullable();
            $table->string('reward')->nullable();
            $table->string('reward_image')->nullable();
            $table->decimal('bonus_point', 7, 0)->nullable();
            $table->string('is_active')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rankings');
    }
};
