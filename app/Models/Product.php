<?php

namespace App\Models;

use App\Services\FileStorageService;
use Gloudemans\Shoppingcart\Contracts\Buyable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Storage;

class Product extends Model implements Buyable
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'SKU',
        'price',
        'discount',
        'quantity',
        'thumbnail',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function thumbnailUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                $thumbnail = $this->attributes['thumbnail'];

                if (!Storage::exists($thumbnail)) {
                    return $thumbnail;
                }

                return Storage::url($thumbnail);
            }
        );
    }

    public function thumbnail(): Attribute
    {
        return Attribute::make(
            set: function ($image) {
                if (!empty($this->attributes['thumbnail'])) {
                    FileStorageService::delete($this->attributes['thumbnail']);
                }

                return FileStorageService::store($image, $this->attributes['slug']);
            }
        );
    }

    public function price(): Attribute
    {
        return Attribute::get(fn () => round($this->attributes['price'], 2));
    }

    public function endPrice(): Attribute
    {
        return Attribute::get(function () {
            $price = $this->attributes['price'];
            $discount = $this->attributes['discount'] ?? 0;

            $endPrice =  $discount === 0
                ? $price
                : ($price - ($price * $discount / 100));

            return $endPrice <= 0 ? 1 : round($endPrice, 2);
        });
    }

    public function getBuyableIdentifier($options = null)
    {
        return $this->id;
    }

    public function getBuyableDescription($options = null)
    {
        return $this->title;
    }

    public function getBuyablePrice($options = null)
    {
        return $this->endPrice;
    }

    public function getBuyableWeight($options = null)
    {
        return 0;
    }
}
