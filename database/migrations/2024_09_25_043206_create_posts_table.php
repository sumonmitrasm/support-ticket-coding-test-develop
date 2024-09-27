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
            $table->integer('user_id')->nullable();
            $table->string('subject');
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('url_structure')->nullable();
            $table->string('heading_tag')->nullable();
            $table->string('schema_markup')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_data')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('meta_robot')->nullable();
            $table->string('canonical_tag')->nullable();
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
