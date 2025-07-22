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
        Schema::table('shipping_addresses', function (Blueprint $table) {
            $table->string('first_name')->after('company_name');
            $table->string('last_name')->after('first_name');
            $table->string('phone')->after('last_name');
            $table->string('email')->after('phone');
            $table->text('order_comments')->nullable()->after('postcode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shipping_addresses', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name', 'phone', 'email', 'order_comments']);
        });
    }
};