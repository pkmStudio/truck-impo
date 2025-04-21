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
        Schema::dropIfExists('category_product');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('category_product', function (Blueprint $table) {
            $table->primary(['category_id', 'product_id']);
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade');
            $table->timestamps();
        });
    }
};
