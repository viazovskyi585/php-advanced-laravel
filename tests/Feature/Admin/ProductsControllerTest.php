<?php

namespace Tests\Feature\Admin;

use App\Enums\Roles;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductsControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function afterRefreshingDatabase()
    {
        $this->seed([
            \Database\Seeders\PermissionSeeder::class,
            \Database\Seeders\UserSeeder::class,
            \Database\Seeders\CategoryProductSeeder::class,
        ]);
    }

    protected function getUser(Roles $role = Roles::ADMIN): User
    {
        return User::role($role->value)->first();
    }

    public function test_allow_see_products_with_admin_role()
    {
        $user = $this->getUser();
        $products = Product::orderByDesc('id')->paginate(8)->pluck('title')->toArray();

        $response = $this->actingAs($user)->get(route('admin.products.index'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.products.products-index');
        $response->assertSeeInOrder($products);

        $response = $this->actingAs($user)->get(route('admin.products.create'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.products.products-create');

        $product = Product::first();
        $response = $this->actingAs($user)->get(route('admin.products.edit', $product));
        $response->assertStatus(200);
        $response->assertViewIs('admin.products.products-edit');
    }

    public function test_deny_see_products_with_customer_role()
    {
        $user = $this->getUser(Roles::CUSTOMER);

        $response = $this->actingAs($user)->get(route('admin.products.index'));
        $response->assertStatus(403);

        $response = $this->actingAs($user)->get(route('admin.products.create'));
        $response->assertStatus(403);

        $product = Product::first();
        $response = $this->actingAs($user)->get(route('admin.products.edit', $product));
        $response->assertStatus(403);
    }

    public function test_create_product_with_valid_data()
    {
        $user = $this->getUser();
        $product = Product::factory()->make();

        $data = array_merge($product->toArray(), [
            'thumbnail' => UploadedFile::fake()->image('image.jpg'),
            'categories' => [Category::first()->id],
        ]);

        $response = $this->actingAs($user)->post(route('admin.products.store'), $data);

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseHas('products', [
            'title' => $product->title,
            'description' => $product->description,
            'price' => $product->price,
        ]);
    }

    public function test_create_product_with_invalid_data()
    {
        $user = $this->getUser();
        $product = Product::factory()->make();

        $response = $this->actingAs($user)->post(route('admin.products.store'), [
            'title' => 'x',
            'price' => 10,
            'categories' => [],
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['title', 'thumbnail', 'discount', 'SKU', 'quantity']);
        $this->assertDatabaseMissing('products', [
            'title' => $product->title,
            'description' => $product->description,
            'price' => $product->price,
        ]);
    }

    public function test_destroy_product()
    {
        $user = $this->getUser();
        $product = Product::factory()->create();

        $response = $this->actingAs($user)->delete(route('admin.products.destroy', $product));

        $response->assertStatus(302);
        $response->assertSessionHasNoErrors();
        $this->assertDatabaseMissing('products', [
            'title' => $product->title,
            'description' => $product->description,
            'price' => $product->price,
        ]);
    }
}
