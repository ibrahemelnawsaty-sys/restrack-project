<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            $table->string('page_slug', 100);
            $table->string('section_key', 100);
            $table->text('title_ar')->nullable();
            $table->text('title_en')->nullable();
            $table->text('subtitle_ar')->nullable();
            $table->text('subtitle_en')->nullable();
            $table->longText('content_ar')->nullable();
            $table->longText('content_en')->nullable();
            $table->string('image')->nullable();
            $table->string('background_image')->nullable();
            $table->string('cta_text_ar')->nullable();
            $table->string('cta_text_en')->nullable();
            $table->string('cta_url', 500)->nullable();
            $table->json('extra_data')->nullable();
            $table->unsignedSmallInteger('display_order')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->foreignId('updated_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->unique(['page_slug', 'section_key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};
