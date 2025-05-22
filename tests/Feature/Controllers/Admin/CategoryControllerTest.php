<?php

namespace Tests\Feature\Controllers\Admin;

use Tests\TestCase;
use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testAdminCanAccessCategoryIndexPage()
    {
        // Создаем администратора
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        // Создаем несколько категорий
        $categories = Category::factory()->count(3)->create();

        // Аутентифицируем администратора и отправляем GET-запрос
        $response = $this->actingAs($admin)->get(route('admin.categories.index'));

        // Проверяем, что ответ успешный (HTTP 200)
        $response->assertStatus(200);
        // Проверяем, что используется правильное представление
        $response->assertViewIs('admin.category.index');
        $response->assertViewHas('categories', fn ($cats) => $cats->every(fn ($cat) => !empty($cat->title)));
    }

    public function testAdminCanAccessCategoryCreatePage()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->get(route('admin.categories.create'));

        $response->assertStatus(200);
        $response->assertViewIs('admin.category.create');

        // Проверяем, что в представлении есть список категорий
        $response->assertViewHas('categories', fn ($cats) => $cats->every(fn ($cat) => !empty($cat->title)));
    }

    public function testAdminCanStoreCategory()
    {
        $admin = User::factory()->create(['is_admin' => true]);

        $response = $this->actingAs($admin)->post(route('admin.categories.store'), [
            'category' => [
                'title' => 'Новая категория',
                'description' => 'Описание категории',
                'content' => '{}',
                'image_path' => 'image.jpg',
                'slug' => 'new-category',
                'type' => 'model',
            ],
            'meta' => [],
        ]);

        $response->assertRedirect(route('admin.categories.create'));
        $this->assertDatabaseHas('categories', ['title' => 'Новая категория']);
    }

    public function testAdminCanAccessCategoryEditPage()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $category = Category::factory()->create();

        $response = $this->actingAs($admin)->get(route('admin.categories.edit', $category));

        $response->assertStatus(200);
        $response->assertViewIs('admin.category.edit');
        $response->assertViewHas('category', $category);
    }

    public function testAdminCanUpdateCategory()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $category = Category::factory()->create(['title' => 'Старая категория']);

        $response = $this->actingAs($admin)->put(route('admin.categories.update', $category), [
            'category' => [
                'title' => 'Обновленная категория',
                'description' => 'Новое описание',
                'content' => '{}',
                'image_path' => 'new-image.jpg',
                'slug' => 'updated-category',
                'type' => 'manufacturer',
            ],
            'meta' => [],
        ]);

        $response->assertRedirect(route('admin.categories.index'));
        $this->assertDatabaseHas('categories', ['id' => $category->id, 'title' => 'Обновленная категория']);
    }

    public function testAdminCanDestroyCategory()
    {
        $admin = User::factory()->create(['is_admin' => true]);
        $category = Category::factory()->create();

        $response = $this->actingAs($admin)->delete(route('admin.categories.destroy', $category));

        $response->assertRedirect(route('admin.categories.index'));
        $this->assertDatabaseMissing('categories', ['id' => $category->id]);
    }


}
