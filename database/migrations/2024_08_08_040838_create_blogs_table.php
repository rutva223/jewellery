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
        if (!Schema::hasTable('blogs'))
        {
            Schema::create('blogs', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('cat_id')->nullable();
                $table->foreign('cat_id')->references('id')->on('categories')->onDelete('cascade');
                $table->unsignedBigInteger('sub_cat_id')->nullable();
                $table->foreign('sub_cat_id')->references('id')->on('sub_categories')->onDelete('cascade');
                $table->string('title')->nullable();
                $table->string('title_slug')->nullable();
                $table->longText('image')->nullable();
                $table->string('headline')->nullable();
                $table->longText('description')->charset('utf8mb4')->collation('utf8mb4_unicode_ci')->nullable();
                $table->string('status')->default('Active');
                $table->integer('is_deleted')->comment('0-not deleted, 1-deleted')->default(0);
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
