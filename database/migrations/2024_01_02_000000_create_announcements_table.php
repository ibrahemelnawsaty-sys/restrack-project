<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['bar', 'popup'])->default('bar');
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->text('body_ar')->nullable();
            $table->text('body_en')->nullable();
            $table->string('link_url', 500)->nullable();
            $table->string('link_text_ar')->nullable();
            $table->string('link_text_en')->nullable();
            $table->string('image')->nullable();
            $table->string('bg_color', 20)->nullable()->default('#af9136');
            $table->string('text_color', 20)->nullable()->default('#16264b');
            $table->boolean('is_active')->default(true);
            $table->boolean('is_dismissible')->default(true);
            $table->dateTime('starts_at')->nullable();
            $table->dateTime('ends_at')->nullable();
            $table->unsignedInteger('display_order')->default(0);
            $table->timestamps();

            $table->index(['type', 'is_active']);
            $table->index('display_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
