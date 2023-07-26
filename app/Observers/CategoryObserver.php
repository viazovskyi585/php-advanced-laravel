<?php

namespace App\Observers;

use App\Models\Category;
use App\Services\FileStorageService;

class CategoryObserver
{
    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Category $category): void
    {
        $category->image->delete();
        FileStorageService::delete($category->image->path);
        FileStorageService::deleteDirectory($category->slug);
    }
}
