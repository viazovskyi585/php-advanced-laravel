<?php

namespace App\Models;

use App\Services\FileStorageService;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['path', 'imageable_id', 'imageable_type'];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    protected function path(): Attribute
    {
        return Attribute::make(
            set: function (array $value) {
                return FileStorageService::store($value['image'], $value['directory'] ?? null);
            },
        );
    }

    public function url(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (str_starts_with($this->attributes['path'], 'http')) {
                    return $this->attributes['path'];
                }

                if (!Storage::exists($this->attributes['path'])) {
                    return $this->attributes['path'];
                }

                return Storage::url($this->attributes['path']);
            }
        );
    }
}
