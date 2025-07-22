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
        Schema::table('fronted_users', function (Blueprint $table) {
            if (!Schema::hasColumn('fronted_users', 'name')) {
                $table->string('name')->nullable()->after('id');
            }
            if (!Schema::hasColumn('fronted_users', 'first_name')) {
                $table->string('first_name')->nullable()->after('name');
            }
            if (!Schema::hasColumn('fronted_users', 'last_name')) {
                $table->string('last_name')->nullable()->after('first_name');
            }
            if (!Schema::hasColumn('fronted_users', 'phone')) {
                $table->string('phone')->nullable()->after('email');
            }
            if (!Schema::hasColumn('fronted_users', 'email_verified_at')) {
                $table->timestamp('email_verified_at')->nullable()->after('phone');
            }
            if (!Schema::hasColumn('fronted_users', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('last_login');
            }
            if (!Schema::hasColumn('fronted_users', 'remember_token')) {
                $table->rememberToken()->after('password');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fronted_users', function (Blueprint $table) {
            $columns = ['name', 'first_name', 'last_name', 'phone', 'email_verified_at', 'is_active', 'remember_token'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('fronted_users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};