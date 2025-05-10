<?php

namespace Tests\Unit;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class BrandTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_brand_has_many_products()
    {
        $brand = Brand::factory()->create();
        $category = Category::factory()->create();

        $product = Product::factory()->create([
            'brand_id' => $brand->id,
            'category_id' => $category->id,
        ]);

        $this->assertInstanceOf(Product::class, $brand->products->first());
    }
}
