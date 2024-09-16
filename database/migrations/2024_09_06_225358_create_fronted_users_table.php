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
        Schema::create('fronted_users', function (Blueprint $table) {
            $table->id();
            $table->string('user_name')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->timestamp('last_login')->nullable();
            $table->boolean('is_deleted')->comment('0-not deleted, 1-deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fronted_users');
    }
};
