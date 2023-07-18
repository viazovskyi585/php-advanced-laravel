<?php

namespace App\Services\Contracts;

use Illuminate\Http\UploadedFile;

interface FileStorageServiceContract
{
    public static function store(UploadedFile | string $file, ?string $additionalPath = ''): string;

    public static function delete(string $path): void;
}
