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
    public function testBrandHasManyProducts()
    {
        $brand = Brand::factory()->create();
        Product::factory()->count(2)->create(['brand_id' => $brand->id]);

        $this->assertCount(2, $brand->products);
        $this->assertInstanceOf(Product::class, $brand->products->first());
    }
}
