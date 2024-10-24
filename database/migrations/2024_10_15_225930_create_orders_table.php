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

        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->unsignedBigInteger('user_id')->nullable(); // User who placed the order
            $table->string('order_number')->unique(); // Unique order identifier
            $table->decimal('total_amount', 10, 2); // Total amount for the order
            $table->string('payment_status'); // e.g. 'pending', 'completed', 'failed'
            $table->string('shipping_status')->default('pending'); // e.g. 'pending', 'shipped', 'delivered'
            $table->unsignedBigInteger('shipping_address_id'); // Foreign key to shipping address
            $table->text('order_notes')->nullable(); // Optional notes about the order
            $table->timestamps(); // Timestamps for created_at and updated_at

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('shipping_address_id')->references('id')->on('shipping_addresses')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
