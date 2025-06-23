<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasImage
{
    /**
     * Store an uploaded image
     */
    public function storeImage(UploadedFile $file, string $directory = 'images'): string
    {
        return $file->store($directory, 'public');
    }

    /**
     * Delete an image from storage
     */
    public function deleteImage(?string $imagePath): bool
    {
        if ($imagePath && Storage::disk('public')->exists($imagePath)) {
            return Storage::disk('public')->delete($imagePath);
        }
        
        return false;
    }

    /**
     * Get the full URL of an image
     */
    public function getImageUrl(?string $imagePath): ?string
    {
        return $imagePath ? asset('storage/' . $imagePath) : null;
    }

    /**
     * Update image: delete old one and store new one
     */
    public function updateImage(UploadedFile $newImage, ?string $oldImagePath, string $directory = 'images'): string
    {
        // Delete old image if exists
        if ($oldImagePath) {
            $this->deleteImage($oldImagePath);
        }

        // Store new image
        return $this->storeImage($newImage, $directory);
    }
}
