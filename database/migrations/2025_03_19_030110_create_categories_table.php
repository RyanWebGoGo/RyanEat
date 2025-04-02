<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * Schema::create('categories', function (Blueprint $table) {
     * $table->id(); // Auto-incrementing primary key
     * $table->string('name'); // Category name (e.g., "Appetizers")
     * $table->text('description')->nullable(); // Optional description
     * $table->integer('sorting')->default(0); // Sorting order (e.g., for menu display)
     * $table->string('image')->nullable(); // Path or URL to category image
     * $table->string('slug')->unique(); // URL-friendly identifier (e.g., "appetizers")
     * $table->boolean('is_display')->default(true); // Whether to display the category
     * $table->timestamps(); // Created_at and updated_at columns
     * });
     *
     */
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('sorting')->default(0); //orderby Desc
            $table->string('image')->nullable();
            $table->string('slug')->unique(); //SEO url : RyanEat.domain/category/{{$slug}}
            $table->boolean('is_display')->default(true);
            $table->timestamps();
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
