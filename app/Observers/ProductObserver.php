<?php

namespace App\Observers;

use App\Models\Product;
use App\Services\FileStorageService;

class ProductObserver
{
    /**
     * Handle the Product "updated" event.
     */
    public function updated(Product $product): void
    {
        if ($product->isDirty('thumbnail')) {
            FileStorageService::delete($product->getOriginal('thumbnail'));
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        if ($product->images) {
            $product->images->each->delete();
        }

        FileStorageService::delete($product->thumbnail);
        FileStorageService::deleteDirectory($product->slug);
    }
}
