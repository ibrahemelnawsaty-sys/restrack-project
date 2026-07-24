<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo_meta', function (Blueprint $table) {
            $table->id();
            $table->string('page_slug', 100)->unique();
            $table->string('meta_title_ar')->nullable();
            $table->string('meta_title_en')->nullable();
            $table->string('meta_description_ar', 500)->nullable();
            $table->string('meta_description_en', 500)->nullable();
            $table->string('meta_keywords_ar', 500)->nullable();
            $table->string('meta_keywords_en', 500)->nullable();
            $table->string('og_title_ar')->nullable();
            $table->string('og_title_en')->nullable();
            $table->string('og_description_ar', 500)->nullable();
            $table->string('og_description_en', 500)->nullable();
            $table->string('og_image')->nullable();
            $table->string('canonical_url', 500)->nullable();
            $table->string('robots', 100)->default('index, follow');
            $table->json('schema_markup')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo_meta');
    }
};
