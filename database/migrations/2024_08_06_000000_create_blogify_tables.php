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
    // Posts Table
    Schema::create('blogify_posts', function (Blueprint $table) {
      $table->id();
      $table->foreignId('author_id');
      $table->foreignId('category_id')->nullable()->constrained('blogify_categories')->nullOnDelete();
      $table->json('title');
      $table->json('slug')->unique();
      $table->longText('json');
      $table->json('meta_title')->nullable();
      $table->json('meta_description')->nullable();
      $table->string('status')->default('draft');
      $table->timestamp('published_at')->nullable();
      $table->unsignedBigInteger('view_count')->default(0);
      $table->json('interactions')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });

    // Categories Table
    Schema::create('blogify_categories', function (Blueprint $table) {
      $table->id();
      $table->foreignId('parent_id')->nullable()->constrained('blogify_categories')->nullOnDelete();
      $table->json('name');
      $table->json('slug')->unique();
      $table->json('description')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });

    // Tags Table
    Schema::create('blogify_tags', function (Blueprint $table) {
      $table->id();
      $table->json('name');
      $table->json('slug')->unique();
      $table->timestamps();
      $table->softDeletes();
    });

    // Pivot table for posts and tags
    Schema::create('blogify_post_tag', function (Blueprint $table) {
      $table->foreignId('post_id')->constrained('blogify_posts')->cascadeOnDelete();
      $table->foreignId('tag_id')->constrained('blogify_tags')->cascadeOnDelete();
      $table->primary(['post_id', 'tag_id']);
    });

    // Media Table
    Schema::create('blogify_media', function (Blueprint $table) {
      $table->id();
      $table->string('disk');
      $table->string('directory');
      $table->string('filename');
      $table->string('original_filename');
      $table->string('mime_type');
      $table->unsignedBigInteger('size');
      $table->json('alt_text')->nullable();
      $table->timestamps();
      $table->softDeletes();
    });

    // Media-post table
    Schema::create('blogify_media_post', function (Blueprint $table) {
      $table->foreignId('media_id')->constrained('blogify_media')->cascadeOnDelete();
      $table->foreignId('post_id')->constrained('blogify_posts')->cascadeOnDelete();
      $table->primary(['media_id', 'post_id']);
    });

  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('blogify_post_tag');
    Schema::dropIfExists('blogify_posts');
    Schema::dropIfExists('blogify_categories');
    Schema::dropIfExists('blogify_tags');
    Schema::dropIfExists('blogify_media');
    Schema::dropIfExists('blogify_media_post');
  }
};
