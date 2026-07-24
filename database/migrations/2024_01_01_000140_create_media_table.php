<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('original_name');
            $table->string('mime_type', 100);
            $table->unsignedInteger('size');
            $table->string('path', 500);
            $table->string('alt_text_ar')->nullable();
            $table->string('alt_text_en')->nullable();
            $table->string('folder', 100)->default('general');
            $table->foreignId('uploaded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->index('folder');
            $table->index('mime_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
