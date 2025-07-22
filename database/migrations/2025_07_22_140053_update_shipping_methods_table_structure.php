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
        Schema::table('shipping_methods', function (Blueprint $table) {
            // Drop existing columns that don't match our new structure
            if (Schema::hasColumn('shipping_methods', 'code')) {
                $table->dropColumn('code');
            }
            if (Schema::hasColumn('shipping_methods', 'min_order_amount')) {
                $table->dropColumn('min_order_amount');
            }
            if (Schema::hasColumn('shipping_methods', 'max_order_amount')) {
                $table->dropColumn('max_order_amount');
            }
            if (Schema::hasColumn('shipping_methods', 'estimated_days')) {
                $table->dropColumn('estimated_days');
            }
            
            // Add new columns if they don't exist
            if (!Schema::hasColumn('shipping_methods', 'type')) {
                $table->string('type')->after('name'); // 'free', 'flat_rate'
            }
            if (!Schema::hasColumn('shipping_methods', 'minimum_order_amount')) {
                $table->decimal('minimum_order_amount', 8, 2)->nullable()->after('cost');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('shipping_methods', function (Blueprint $table) {
            // Add back the old columns
            $table->string('code')->nullable();
            $table->decimal('min_order_amount', 8, 2)->nullable();
            $table->decimal('max_order_amount', 8, 2)->nullable();
            $table->integer('estimated_days')->nullable();
            
            // Drop new columns
            $table->dropColumn(['type', 'minimum_order_amount']);
        });
    }
};
