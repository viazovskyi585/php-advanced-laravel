<?php

namespace Tests\Feature\Admin;

use App\Enums\Roles;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class CategoriesControllerTest extends TestCase
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

    public function test_allow_see_categories_with_admin_role()
    {
        $user = $this->getUser();
        $categories = Category::orderByDesc('id')->paginate(8)->pluck('name')->toArray();

        $response = $this->actingAs($user)->get(route('admin.categories.index'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.categories.categories-index');
        $response->assertSeeInOrder($categories);

        $response = $this->actingAs($user)->get(route('admin.categories.create'));
        $response->assertStatus(200);
        $response->assertViewIs('admin.categories.categories-create');

        $response = $this->actingAs($user)->get(route('admin.categories.edit', ['category' => 1]));
        $response->assertStatus(200);
        $response->assertViewIs('admin.categories.categories-edit');
    }

    public function test_deny_see_categories_with_customer_role()
    {
        $user = $this->getUser(Roles::CUSTOMER);

        $response = $this->actingAs($user)->get(route('admin.categories.index'));
        $response->assertStatus(403);

        $response = $this->actingAs($user)->get(route('admin.categories.create'));
        $response->assertStatus(403);

        $response = $this->actingAs($user)->get(route('admin.categories.edit', ['category' => 1]));
        $response->assertStatus(403);
    }

    public function test_create_category_with_valid_data()
    {
        $user = $this->getUser();
        $category = Category::factory()->make();

        $response = $this->actingAs($user)->post(route('admin.categories.store'), [
            'name' => $category->name,
            'description' => $category->description,
            'image' => UploadedFile::fake()->image('image.jpg'),
        ]);

        $response->assertStatus(302);
        $response->assertRedirect(route('admin.categories.index'));
        $this->assertDatabaseHas('categories', [
            'name' => $category->name,
            'description' => $category->description,
        ]);
    }

    public function test_create_category_with_invalid_data()
    {
        $user = $this->getUser();

        $response = $this->actingAs($user)->post(route('admin.categories.store'), [
            'name' => 'x',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name', 'image']);
        $this->assertDatabaseMissing('categories', [
            'name' => 'x',
        ]);
    }

    public function test_update_category_with_valid_data()
    {
        $user = $this->getUser();
        $category = Category::factory()->create();
        $newCategory = Category::factory()->make();

        $response = $this->actingAs($user)->put(route('admin.categories.update', ['category' => $category->id]), [
            'name' => $newCategory->name,
            'description' => $newCategory->description,
        ]);

        $response->assertStatus(302);
        $this->assertDatabaseHas('categories', [
            'name' => $newCategory->name,
            'description' => $newCategory->description,
        ]);
    }

    public function test_update_category_with_invalid_data()
    {
        $user = $this->getUser();
        $category = Category::factory()->create();

        $response = $this->actingAs($user)->put(route('admin.categories.update', ['category' => $category->id]), [
            'name' => 'x',
        ]);

        $response->assertStatus(302);
        $response->assertSessionHasErrors(['name']);
        $this->assertDatabaseMissing('categories', [
            'name' => 'x',
        ]);
    }

    public function test_create_and_destroy_category()
    {
        $user = $this->getUser();

        $this->actingAs($user)->post(route('admin.categories.store'), [
            'name' => 'xxx',
            'image' => UploadedFile::fake()->image('image.jpg'),
        ]);

        $category = Category::where('name', 'xxx')->first();

        $response = $this->actingAs($user)->delete(route('admin.categories.destroy', ['category' => $category->id]));

        $response->assertStatus(302);
        $this->assertDatabaseMissing('categories', [
            'id' => $category->id,
        ]);
    }
}
