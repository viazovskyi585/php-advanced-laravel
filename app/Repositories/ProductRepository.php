<?php

namespace App\Repositories;

use App\Http\Requests\Admin\Products\StoreProductRequest;
use App\Http\Requests\Admin\Products\UpdateProductRequest;
use App\Models\Product;
use App\Repositories\Contracts\ImageRepositoryContract;
use App\Repositories\Contracts\ProductRepositoryContract;
use DB;
use Illuminate\Support\Str;

class ProductRepository implements ProductRepositoryContract
{
    public function __construct(protected ImageRepositoryContract $imageRepository)
    {
    }

    public function create(StoreProductRequest $request): Product|false
    {
        try {
            DB::beginTransaction();
            $data = $this->processRequestData($request);
            $product = Product::create($data['attributes']);
            $this->attachRelationalData($product, $data);

            DB::commit();
            return $product;
        } catch (\Exception $exception) {
            DB::rollBack();
            logs()->warning($exception);
            return false;
        }
    }

    public function update(UpdateProductRequest $request): Product|false
    {
        try {
            DB::beginTransaction();
            $data = $this->processRequestData($request);
            $product = $request->route('product');
            $product->update($data['attributes']);
            $this->attachRelationalData($product, $data);

            DB::commit();
            return $product;
        } catch (\Exception $exception) {
            DB::rollBack();
            logs()->warning($exception);
            return false;
        }
    }

    protected function processRequestData(StoreProductRequest|UpdateProductRequest $request): array
    {
        $validated = $request->validated();
        $attributes = collect($validated)->except(['categories'])->toArray();

        $attributes['slug'] = $this->generateSlug($attributes['title']);
        ksort($attributes);

        return [
            'attributes' => $attributes,
            'categories' => array_filter($request->get('categories', []), fn ($category) => !is_null($category)),
        ];
    }

    protected function attachCategories(Product $product, array $categories): void
    {
        if (!empty($categories)) {
            $product->categories()->attach($categories);
        }
    }

    protected function generateSlug(string $title): string
    {
        return Str::slug($title, '-');
    }

    protected function attachRelationalData(Product $product, array $data): void
    {
        $this->attachCategories($product, $data['categories']);

        if (!empty($data['attributes']['images'])) {
            $this->imageRepository->attach($product, 'images', $data['attributes']['images'], $data['attributes']['slug']);
        }
    }
}
