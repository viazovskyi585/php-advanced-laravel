<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category_product')->delete();
        DB::table('categories')->delete();
        DB::table('products')->delete();

        Category::factory(3)
            ->create()
            ->each(function (Category $category) {
                $this->createAndAttachProducts($category, rand(1, 3));
            });

        Category::factory(3)
            ->create()
            ->each(function (Category $category) {
                Category::factory(rand(1, 3))->create([
                    'parent_id' => $category->id,
                ])->each(function (Category $category) {
                    $this->createAndAttachProducts($category, rand(1, 3));
                });
            });
    }

    protected function createAndAttachProducts(Category $category, int $count): void
    {
        $category->products()->attach(
            Product::factory($count)->create()->pluck('id')
        );
    }
}
