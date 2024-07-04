<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Image;
use Intervention\Image\ImageManager;


class UploadService
{
    public static function resize($filePath, $width, $height): Image
    {
        // Create an instance from the file located at $filePath
        $manager = new ImageManager(new Driver());
        $img = $manager->read($filePath);

        // Resize the image to a width of $width and constrain aspect ratio
        // This will auto-adjust the height if necessary
        $img->scale($width, $height);
        return $img;
    }

    public static function uploadImage($image, $name, $directory = 'cars/', $visibility = 'public'): string
    {
        try {
            $path = $directory . $name;
            Storage::disk('spaces')->put($path, $image->encode(), ['visibility' => $visibility]);
            return Storage::disk('spaces')->url($path);
        } catch (\Exception $e) {
            Log::error("Failed to upload image: " . $e->getMessage());
            throw new \Exception("Failed to upload image: " . $e->getMessage());
        }
    }
}
