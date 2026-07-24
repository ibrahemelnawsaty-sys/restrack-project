<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('level_id')->constrained()->cascadeOnDelete();
            $table->text('question_ar');
            $table->text('question_en');
            $table->enum('type', ['mcq', 'true_false'])->default('mcq');
            $table->json('options_ar');
            $table->json('options_en');
            $table->string('correct_answer', 10);
            $table->text('explanation_ar')->nullable();
            $table->text('explanation_en')->nullable();
            $table->enum('difficulty', ['easy', 'medium', 'hard'])->default('medium');
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->index(['level_id', 'is_active']);
            $table->index('difficulty');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('questions');
    }
};
