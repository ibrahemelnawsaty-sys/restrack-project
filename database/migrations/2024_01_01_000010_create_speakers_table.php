<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('speakers', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('slug')->unique();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->string('specialization_ar')->nullable();
            $table->string('specialization_en')->nullable();
            $table->text('bio_ar')->nullable();
            $table->text('bio_en')->nullable();
            $table->string('short_bio_ar', 500)->nullable();
            $table->string('short_bio_en', 500)->nullable();
            $table->string('photo')->nullable();
            $table->string('cover_photo')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 20)->nullable();
            $table->json('achievements')->nullable();
            $table->json('qualifications')->nullable();
            $table->json('social_links')->nullable();
            $table->json('affiliated_institutions')->nullable();
            $table->unsignedTinyInteger('years_of_experience')->nullable();
            $table->unsignedSmallInteger('display_order')->default(0);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_visible')->default(true);
            $table->string('meta_title')->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->timestamps();

            $table->index(['display_order', 'is_visible']);
            $table->index('is_featured');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('speakers');
    }
};
