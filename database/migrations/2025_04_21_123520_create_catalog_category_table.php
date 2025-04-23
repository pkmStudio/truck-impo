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
        Schema::create('catalog_category', function (Blueprint $table) {
            $table->primary(['category_id', 'catalog_id']);
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('catalog_id')->constrained('catalogs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('catalog_category');
    }
};
