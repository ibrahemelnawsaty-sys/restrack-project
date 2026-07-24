<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Add self-hosted video fields to lectures. All columns are nullable/defaulted
     * so this is purely additive — existing external-embed rows are untouched, and
     * down() cleanly drops only what up() added. The self-hosted path is keyed by
     * video_provider = 'custom' (already an allowed enum value).
     */
    public function up(): void
    {
        Schema::table('lectures', function (Blueprint $table) {
            // Where the source/playable file lives (private disk name).
            $table->string('video_disk')->nullable();
            // Original uploaded/source file on the private disk (MP4 fallback playback + HLS source).
            $table->string('video_path')->nullable();
            // Processing lifecycle for the self-hosted asset.
            $table->enum('video_status', ['none', 'queued', 'processing', 'ready', 'failed'])->default('none');
            $table->string('video_mime')->nullable();
            $table->unsignedBigInteger('video_size')->nullable();
            $table->string('video_original_name')->nullable();
            // Precise duration in seconds (from ffprobe); duration_minutes stays for display.
            $table->unsignedInteger('video_duration_seconds')->nullable();
            // Encrypted-HLS output (master playlist + AES key), when FFmpeg packaging is available.
            $table->string('hls_path')->nullable();
            $table->string('hls_key_path')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('lectures', function (Blueprint $table) {
            $table->dropColumn([
                'video_disk',
                'video_path',
                'video_status',
                'video_mime',
                'video_size',
                'video_original_name',
                'video_duration_seconds',
                'hls_path',
                'hls_key_path',
            ]);
        });
    }
};
