<?php

namespace App\Repositories\Contracts;

use App\Http\Requests\Admin\Categories\StoreCategoryRequest;
use App\Http\Requests\Admin\Categories\UpdateCategoryRequest;
use App\Models\Category;

interface CategoryRepositoryContract
{
    public function create(StoreCategoryRequest $request): Category|false;
    public function update(Category $category, UpdateCategoryRequest $request): bool;
}
