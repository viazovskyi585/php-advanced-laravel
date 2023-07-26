<?php

namespace App\Repositories;

use App\Http\Requests\Admin\Categories\StoreCategoryRequest;
use App\Http\Requests\Admin\Categories\UpdateCategoryRequest;
use App\Http\Requests\Admin\Products\StoreProductRequest;
use App\Http\Requests\Admin\Products\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use App\Repositories\Contracts\CategoryRepositoryContract;
use App\Repositories\Contracts\ImageRepositoryContract;
use App\Repositories\Contracts\ProductRepositoryContract;
use DB;
use Illuminate\Support\Str;

class CategoryRepository implements CategoryRepositoryContract
{
    public function __construct(protected ImageRepositoryContract $imageRepository)
    {
    }

    public function create(StoreCategoryRequest $request): Category|false
    {
        try {
            DB::beginTransaction();
            $data = $this->processRequestData($request);
            $category = Category::create($data);
            $this->imageRepository->attach($category, 'image', [$data['image']], $data['slug']);

            DB::commit();
            return $category;
        } catch (\Exception $exception) {
            DB::rollBack();
            logs()->warning($exception);
            return false;
        }
    }

    public function update(Category $category, UpdateCategoryRequest $request): bool
    {
        try {
            DB::beginTransaction();
            $data = $this->processRequestData($request);
            $category->update($data);

            if ($request->hasFile('image')) {
                $category->image->delete();
                $this->imageRepository->attach($category, 'image', [$data['image']], $data['slug']);
            }

            DB::commit();
            return true;
        } catch (\Exception $exception) {
            DB::rollBack();
            logs()->warning($exception);
            return false;
        }
    }

    protected function processRequestData(StoreCategoryRequest|UpdateCategoryRequest $request): array
    {
        $data = $request->validated();
        $data['slug'] = Str::of($data['name'])->slug('-');

        return $data;
    }
}
