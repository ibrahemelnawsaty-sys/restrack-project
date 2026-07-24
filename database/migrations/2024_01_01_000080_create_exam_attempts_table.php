<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('exam_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('level_id')->constrained()->cascadeOnDelete();
            $table->decimal('score', 5, 2);
            $table->unsignedTinyInteger('total_questions');
            $table->unsignedTinyInteger('correct_answers');
            $table->boolean('passed')->default(false);
            $table->unsignedInteger('time_spent_seconds')->nullable();
            $table->json('questions_snapshot');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->index(['user_id', 'level_id']);
            $table->index('passed');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('exam_attempts');
    }
};
