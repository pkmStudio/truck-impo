<?php

namespace Tests\Feature\Controllers\Api\V1\Client;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function testShowBrandReturnsCorrectCategory()
    {
        $brand = Category::factory()->create(['type' => 'manufacturer', 'slug' => 'bmw']);
        $model = Category::factory()->create(['type' => 'model', 'parent_id' => $brand->id, 'slug' => 'bmw-x5']);

        $response = $this->getJson(route('v1.client.categories.brand.show', ['brandSlug' => 'bmw']));

        $response->assertStatus(200);
        $response->assertJson([
            'slug' => 'bmw',
            'children' => [['slug' => 'bmw-x5']],
        ]);
    }

    public function testShowModelReturnsCorrectCategory()
    {
        $brand = Category::factory()->create(['type' => 'manufacturer', 'slug' => 'bmw']);
        $model = Category::factory()->create(['type' => 'model', 'parent_id' => $brand->id, 'slug' => 'bmw-x5']);
        $part = Category::factory()->create(['type' => 'part', 'parent_id' => $brand->id, 'slug' => 'tormaza']);


        $response = $this->getJson(route('v1.client.categories.model.show', ['brandSlug' => 'bmw', 'modelSlug' => 'bmw-x5']));

        $response->assertStatus(200);
        $response->assertJson([
            'slug' => 'bmw-x5',
            'parts' => [
                ['slug' => 'tormaza']
            ],
        ]);
    }

    /**
     * testShowPartReturnsCorrectCategory()
     * testShowBrandReturns404ForInvalidSlug()
     * testShowModelReturns404ForInvalidSlug()
     * testShowPartReturns404ForInvalidSlug()
     */
}
