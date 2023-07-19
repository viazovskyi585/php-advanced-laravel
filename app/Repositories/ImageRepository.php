<?php

namespace App\Repositories;

use App\Repositories\Contracts\ImageRepositoryContract;
use Illuminate\Database\Eloquent\Model;

class ImageRepository implements ImageRepositoryContract
{
    public function attach(Model $model, string $relation, array $images = [], ?string $directory = null): void
    {
        if (!method_exists($model, $relation)) {
            throw new \Exception($model::class . " Relation {$relation} does not exist");
        }

        $images = array_filter($images, fn ($image) => !is_null($image));

        if (empty($images)) {
            return;
        }

        call_user_func([$model, $relation])->createMany(
            array_map(
                fn ($image) => [
                    'path' => [
                        'image' => $image,
                        'directory' => $directory,
                    ],
                ],
                $images
            )
        );
    }
}
