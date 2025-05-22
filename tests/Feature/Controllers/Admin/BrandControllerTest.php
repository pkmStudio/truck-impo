<?php
namespace Tests\Feature\Controllers\Admin;

use Tests\TestCase;
use App\Models\Brand;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BrandControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testAdminCanStoreBrand()
    {
        // Создаем администратора
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        // Аутентифицируем его
        $response = $this->actingAs($admin)->post(route('admin.brands.store'), [
            'title' => 'Новый бренд',
        ]);

        // Проверяем, что редирект произошел корректно
        $response->assertRedirect(route('admin.brands.create'));
        // Проверяем, что бренд появился в базе данных
        $this->assertDatabaseHas('brands', ['title' => 'Новый бренд']);
        // Проверяем, что сообщение сессии успешно установлено
        $this->assertEquals('Бренд успешно добавлен!', session('success'));
    }

    public function testAdminCanUpdateBrand()
    {
        // Создаем администратора
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        // Создаем тестовый бренд
        $brand = Brand::factory()->create([
            'title' => 'Старый бренд',
        ]);

        // Аутентифицируем администратора и отправляем PUT-запрос на обновление
        $response = $this->actingAs($admin)->put(route('admin.brands.update', $brand), [
            'title' => 'Обновленный бренд',
        ]);

        // Проверяем, что редирект произошел на страницу списка брендов
        $response->assertRedirect(route('admin.brands.index'));
        // Проверяем, что данные бренда обновились в базе
        $this->assertDatabaseHas('brands', ['id' => $brand->id, 'title' => 'Обновленный бренд']);
    }

    public function testAdminCanDestroyBrand()
    {
        // Создаем администратора
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        // Создаем тестовый бренд
        $brand = Brand::factory()->create();

        // Аутентифицируем администратора и отправляем DELETE-запрос
        $response = $this->actingAs($admin)->delete(route('admin.brands.destroy', $brand));

        // Проверяем, что редирект произошел на страницу списка брендов
        $response->assertRedirect(route('admin.brands.index'));
        // Проверяем, что бренд был удален из базы данных
        $this->assertDatabaseMissing('brands', ['id' => $brand->id]);
    }

    public function testAdminCanAccessEditBrandPage()
    {
        // Создаем администратора
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        // Создаем тестовый бренд
        $brand = Brand::factory()->create();

        // Аутентифицируем администратора и отправляем GET-запрос
        $response = $this->actingAs($admin)->get(route('admin.brands.edit', $brand));

        // Проверяем, что ответ успешный (HTTP 200)
        $response->assertStatus(200);
        // Проверяем, что на странице есть данные бренда
        $response->assertViewIs('admin.brand.edit');
        $response->assertViewHas('brand', $brand);
    }

    public function testAdminCanAccessBrandIndexPage()
    {
        // Создаем администратора
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        // Создаем несколько тестовых брендов
        $brands = Brand::factory()->count(3)->create();

        // Аутентифицируем администратора и отправляем GET-запрос
        $response = $this->actingAs($admin)->get(route('admin.brands.index'));

        // Проверяем, что ответ успешный (HTTP 200)
        $response->assertStatus(200);
        // Проверяем, что используется правильное представление
        $response->assertViewIs('admin.brand.index');
        $response->assertViewHas('brands', $brands);
    }

    public function testAdminCanAccessBrandCreatePage()
    {
        // Создаем администратора
        $admin = User::factory()->create([
            'is_admin' => true,
        ]);

        // Аутентифицируем администратора и отправляем GET-запрос
        $response = $this->actingAs($admin)->get(route('admin.brands.create'));

        // Проверяем, что ответ успешный (HTTP 200)
        $response->assertStatus(200);
        // Проверяем, что используется правильное представление
        $response->assertViewIs('admin.brand.create');
    }
}

