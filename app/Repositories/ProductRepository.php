<?php

namespace App\Repositories;

use App\Http\Requests\Admin\Products\StoreProductRequest;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryContract;
use DB;
use Illuminate\Support\Str;

class ProductRepository implements ProductRepositoryContract
{
    public function create(StoreProductRequest $request): Product|false
    {
        try {
            DB::beginTransaction();
            $data = $this->processRequestData($request);
            ksort($data['attributes']);
            $product = Product::create($data['attributes']);
            $this->attachCategories($product, $data['categories']);

            DB::commit();

            return $product;
        } catch (\Exception $exception) {
            DB::rollBack();
            logs()->warning($exception);
            return false;
        }
    }

    protected function processRequestData(StoreProductRequest $request): array
    {
        $validated = $request->validated();
        $attributes = collect($validated)->except(['categories'])->toArray();

        $attributes['slug'] = $this->generateSlug($attributes['title']);

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
}
