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
        Schema::table('products', function (Blueprint $table) {
            $table->json('available_colors')->nullable()->after('images');
            $table->string('brand')->nullable()->after('available_colors');
            $table->decimal('weight', 8, 2)->nullable()->after('brand');
            $table->json('materials')->nullable()->after('weight');
            $table->boolean('is_featured')->default(false)->after('materials');
            $table->integer('sort_order')->default(0)->after('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['available_colors', 'brand', 'weight', 'materials', 'is_featured', 'sort_order']);
        });
    }
};