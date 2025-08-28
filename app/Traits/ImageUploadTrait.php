<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Encoders\WebpEncoder;
use Intervention\Image\ImageManager;

trait ImageUploadTrait
{
    /**
     * Memproses gambar yang diunggah: resize, crop, kompresi, dan simpan.
     *
     * @param \Illuminate\Http\UploadedFile $file File yang diunggah.
     * @param string $directory Direktori penyimpanan di dalam 'storage/app/public'.
     * @param string $prefix Awalan nama file.
     * @param int $width Lebar target gambar.
     * @param int $height Tinggi target gambar.
     * @param int $targetSizeKB Target maksimal ukuran file dalam KB.
     * @return string Path file yang disimpan.
     */
    public function processImage($file, $directory, $prefix, $width, $height, $targetSizeKB = 300)
    {
        $imageName = $prefix . time() . '.webp';
        $manager = new ImageManager(new Driver());

        // 1. Baca & Proses Awal (Resize & Crop)
        $image = $manager->read($file->getRealPath());
        $image->scaleDown($width, $height); // Mencegah upsize
        $image->cover($width, $height);     // Crop ke ukuran pas

        $imageSaved = false;

        // 2. Kompresi Berulang
        for ($quality = 90; $quality >= 20; $quality -= 10) {
            $encodedImage = (string) $image->encode(new WebpEncoder($quality));
            if (strlen($encodedImage) / 1024 <= $targetSizeKB) {
                Storage::disk('public')->put($directory . '/' . $imageName, $encodedImage);
                $imageSaved = true;
                break;
            }
        }

        // 3. Fallback jika masih terlalu besar
        if (!$imageSaved) {
            $encodedImage = (string) $image->encode(new WebpEncoder(20));
            Storage::disk('public')->put($directory . '/' . $imageName, $encodedImage);
        }

        return $directory . '/' . $imageName;
    }
}