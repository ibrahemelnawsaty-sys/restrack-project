<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lectures', function (Blueprint $table) {
            $table->id();
            $table->foreignId('level_id')->constrained()->cascadeOnDelete();
            $table->foreignId('speaker_id')->nullable()->constrained()->nullOnDelete();
            $table->unsignedSmallInteger('order');
            $table->string('title_ar');
            $table->string('title_en');
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->string('video_url', 500);
            $table->enum('video_provider', ['vimeo', 'youtube', 'custom'])->default('vimeo');
            $table->unsignedSmallInteger('duration_minutes')->nullable();
            $table->string('thumbnail')->nullable();
            $table->json('resources')->nullable();
            $table->boolean('is_published')->default(true);
            $table->boolean('is_free_preview')->default(false);
            $table->timestamps();

            $table->index(['level_id', 'order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lectures');
    }
};
