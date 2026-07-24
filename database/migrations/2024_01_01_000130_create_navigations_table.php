<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('navigations', function (Blueprint $table) {
            $table->id();
            $table->enum('location', ['header', 'footer', 'sidebar']);
            $table->foreignId('parent_id')->nullable()->constrained('navigations')->cascadeOnDelete();
            $table->string('label_ar');
            $table->string('label_en');
            $table->string('url', 500);
            $table->enum('target', ['_self', '_blank'])->default('_self');
            $table->string('icon', 50)->nullable();
            $table->unsignedSmallInteger('display_order')->default(0);
            $table->boolean('is_visible')->default(true);
            $table->timestamps();

            $table->index(['location', 'display_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('navigations');
    }
};
