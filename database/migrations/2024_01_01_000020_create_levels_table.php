<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('levels', function (Blueprint $table) {
            $table->id();
            $table->unsignedTinyInteger('order');
            $table->string('title_ar');
            $table->string('title_en');
            $table->text('description_ar')->nullable();
            $table->text('description_en')->nullable();
            $table->json('learning_outcomes_ar')->nullable();
            $table->json('learning_outcomes_en')->nullable();
            $table->json('topics_ar')->nullable();
            $table->json('topics_en')->nullable();
            $table->unsignedTinyInteger('passing_score')->default(70);
            $table->unsignedTinyInteger('exam_questions_count')->default(30);
            $table->boolean('is_published')->default(false);
            $table->string('icon', 50)->nullable();
            $table->string('color', 7)->nullable();
            $table->timestamps();

            $table->index('order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('levels');
    }
};
