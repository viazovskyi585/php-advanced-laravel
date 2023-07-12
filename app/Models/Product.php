<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Storage;

class Product extends Model
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
}
