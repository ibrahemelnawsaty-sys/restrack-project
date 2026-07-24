<?php

namespace App\Services;

use App\Models\Media;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class MediaService
{
    public function upload(UploadedFile $file, string $folder = 'general', ?int $userId = null): Media
    {
        $path = $file->store("media/{$folder}", 'public');

        return Media::create([
            'filename' => basename($path),
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
            'path' => $path,
            'folder' => $folder,
            'uploaded_by' => $userId ?? auth()->id(),
        ]);
    }

    public function delete(Media $media): bool
    {
        Storage::disk('public')->delete($media->path);
        return $media->delete();
    }
}
