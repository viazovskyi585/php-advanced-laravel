<?php

namespace App\Repositories\Contracts;

use App\Http\Requests\Admin\Products\StoreProductRequest;
use App\Models\Product;

interface ProductRepositoryContract
{
    public function create(StoreProductRequest $request): Product|false;
}
