<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Repositories\ImageRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryProductSeeder extends Seeder
{
    public function __construct(protected ImageRepository $imageRepository)
    {
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('category_product')->delete();
        DB::table('categories')->delete();
        DB::table('products')->delete();

        $this->createCategories(3)
            ->each(function (Category $category) {
                $this->createAndAttachProducts($category, rand(1, 3));
            });


        Product::factory(5)->create()->pluck('id');

        $this->createCategories(3)
            ->each(function (Category $category) {
                $this->createAndAttachProducts($category, rand(1, 3));

                $this->createCategories(rand(1, 3), $category->id)
                    ->each(function (Category $category) {
                        $this->createAndAttachProducts($category, rand(1, 3));
                    });
            });
    }

    protected function createCategories(int $count, ?int $parent_id = null): Collection
    {
        $categories = Category::factory($count)->create([
            'parent_id' => $parent_id,
        ]);

        $categories->each(function (Category $category) {
            $this->imageRepository->attach($category, 'image', [fake()->imageUrl()], $category->slug);
        });

        return $categories;
    }

    protected function createAndAttachProducts(Category $category, int $count): void
    {
        $category->products()->attach(
            Product::factory($count)->create()->pluck('id')
        );
    }
}
