<?php

namespace Tests\Feature\Services\Admin;

use Tests\TestCase;
use App\Models\Category;
use App\Models\MetaTag;
use App\Services\Admin\CategoryService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

class CategoryServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreCreatesCategoryWithMetaTags()
    {
        $data = [
            'category' => [
                'title' => 'Тестовая категория',
                'slug' => 'test-category',
                'type' => 'model',
                'description' => 'Описание категории',
                'content' => '{}',
                'image_path' => 'image.jpg',
            ],
            'meta' => [
                'meta_title' => 'Тестовый мета-тег',
                'meta_description' => 'Описание мета-тега',
            ],
        ];

        $category = CategoryService::store($data);

        $this->assertDatabaseHas('categories', ['title' => 'Тестовая категория']);
        $this->assertDatabaseHas('metatags', [
            'meta_title' => 'Тестовый мета-тег',
            'metatagable_id' => $category->id,
        ]);
    }

    public function testUpdateModifiesCategoryAndMetaTags()
    {
        $category = Category::factory()->create(['title' => 'Старый заголовок']);
        MetaTag::factory()->create([
            'metatagable_id' => $category->id,
            'metatagable_type' => Category::class,
            'meta_title' => 'Старый мета-тег']);

        $data = [
            'category' => [
                'title' => 'Обновленный заголовок',
                'description' => 'Новое описание',
                'image_path' => 'new-image.jpg',
            ],
            'meta' => [
                'meta_title' => 'Обновленный мета-тег',
            ],
        ];

        CategoryService::update($data, $category);

        $this->assertDatabaseHas('categories', ['id' => $category->id, 'title' => 'Обновленный заголовок']);
        $this->assertDatabaseHas('metatags', ['metatagable_id' => $category->id, 'meta_title' => 'Обновленный мета-тег']);
    }

    public function testStoreRollsBackTransactionOnError()
    {
        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('rollBack')->once();

        $this->expectException(\Exception::class);

        CategoryService::store(['category' => [], 'meta' => []]);
    }

    public function testUpdateRollsBackTransactionOnError()
    {
        DB::shouldReceive('beginTransaction')->once();
        DB::shouldReceive('rollBack')->once();

        $category = Category::factory()->create();

        $this->expectException(\Exception::class);

        CategoryService::update(['category' => []], $category);
    }


}
