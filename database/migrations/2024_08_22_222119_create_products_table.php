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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cat_id')->nullable();
            $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('product_name')->nullable();
            $table->string('product_slug')->nullable();
            $table->longText('images')->nullable();
            $table->decimal('product_price', 8, 2)->nullable();
            $table->decimal('sell_price', 8, 2)->nullable();
            $table->decimal('discount', 5, 2)->nullable();
            $table->integer('quantity')->nullable();
            $table->text('description')->nullable();
            $table->string('status')->default('Active');
            $table->boolean('is_deleted')->comment('0-not deleted, 1-deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
