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
        Schema::create('pin_codes', function (Blueprint $table) {
            $table->id();
            $table->string('pin_code')->unique();
            $table->decimal('amount', 10,2)->default(0.00);
            $table->foreignId('admin_id')->nullable();
            $table->foreign('admin_id')->references('id')->on('admins')->onDelete('set null');
            $table->foreignId('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->boolean('is_used')->default(false);
            $table->foreignId('used_by')->nullable();
            $table->foreign('used_by')->references('id')->on('users')->onDelete('set null');
            $table->dateTime('used_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pin_codes');
    }
};
