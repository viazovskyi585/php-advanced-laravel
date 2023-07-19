<?php

namespace App\Services;

use App\Services\Contracts\FileStorageServiceContract;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class FileStorageService implements FileStorageServiceContract
{
    public static function store(UploadedFile | string $file, ?string $additionalPath = ''): string
    {
        if (is_string($file)) {
            return str_replace('public/storage', '', $file);
        }

        $path = "public/{$additionalPath}";

        $filePath = Storage::putFileAs(
            $path,
            $file,
            time() . $file->hashName()
        );

        return $filePath;
    }

    public static function delete(string $path): void
    {
        Storage::delete($path);
    }
}
