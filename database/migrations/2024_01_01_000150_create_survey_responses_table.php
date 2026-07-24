<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('survey_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->unsignedTinyInteger('content_quality');
            $table->unsignedTinyInteger('clarity');
            $table->unsignedTinyInteger('speaker_quality');
            $table->unsignedTinyInteger('tech_quality');
            $table->unsignedTinyInteger('ease_of_use');
            $table->unsignedTinyInteger('overall_satisfaction')->nullable();
            $table->boolean('would_recommend')->default(true);
            $table->text('suggestions')->nullable();
            $table->timestamps();

            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('survey_responses');
    }
};
