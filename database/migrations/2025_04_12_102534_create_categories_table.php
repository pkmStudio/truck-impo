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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('parent_id')->nullable()->index()->constrained('categories')->onDelete('cascade');
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->json('content')->nullable();
            $table->string('image_path')->nullable();
            $table->string('slug')->index();
            $table->enum('type', ['manufacturer', 'model', 'part'])->index()->nullable();
            $table->timestamps();

            // Уникальность slug в рамках parent_id
            $table->unique(['parent_id', 'slug']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
