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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('post_image_path')->nullable();
            $table->text('body');
            $table->foreignId('creator_id')->constrained(
                table: 'users',
                indexName: 'posts_user_id'
            )->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('category_id')->constrained(
                table: 'categories',
                indexName: 'posts_category_id'
            )->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('company_id')->constrained(
                table: 'companies',
                indexName: 'posts_company_id'
            )->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
