<?php

namespace App\Observers;

use App\Models\Image;
use App\Services\FileStorageService;

class ImageObserver
{
    /**
     * Handle the Image "deleted" event.
     */
    public function deleted(Image $image): void
    {
        FileStorageService::delete($image->path);
    }
}
