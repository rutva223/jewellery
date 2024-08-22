<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (!Schema::hasTable('users')) {
            Schema::create('users', function (Blueprint $table) {
                $table->id();
                $table->string('name')->nullable();
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->string('reset_url')->nullable();
                $table->string('status')->default('active');
                $table->integer('email_otp')->nullable();
                $table->timestamp('otp_expired')->nullable();
                $table->integer('is_deleted')->comment('0-not deleted, 1-deleted')->default(0);
                $table->rememberToken();
                $table->timestamps();
            });
            DB::table('users')->truncate();
            $admin = array(
                array('id' => 1, 'name' => 'Admin', 'email' => 'admin@gmail.com', 'is_deleted' => 0, 'password' => Hash::make('123456')),
            );
            DB::table('users')->insert($admin);

        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
