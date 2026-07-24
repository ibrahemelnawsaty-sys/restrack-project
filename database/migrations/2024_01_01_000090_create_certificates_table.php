<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('level_id')->nullable()->constrained()->nullOnDelete();
            $table->string('certificate_number', 50)->unique();
            $table->decimal('score', 5, 2);
            $table->enum('type', ['level', 'final'])->default('level');
            $table->string('file_path')->nullable();
            $table->timestamp('issued_at');
            $table->unsignedInteger('verified_count')->default(0);
            $table->timestamps();

            $table->index('user_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('certificates');
    }
};
