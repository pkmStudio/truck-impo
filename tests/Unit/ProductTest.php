<?php

namespace Tests\Unit;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Characteristic;
use App\Models\Metatag;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use RefreshDatabase;

    public function testProductBelongsToBrand()
    {
        $brand = Brand::factory()->create();
        $product = Product::factory()->create([
            'brand_id' => $brand->id
        ]);

        $this->assertInstanceOf(Brand::class, $product->brand);
    }

    public function testProductHasManyCharacteristics()
    {
        $product = Product::factory()->create();
        Characteristic::factory()->count(2)->create([
            'product_id' => $product->id
        ]);


        $this->assertCount(2, $product->characteristics);
        $this->assertInstanceOf(Characteristic::class, $product->characteristics->first());
    }

    public function testProductBelongsToCategory()
    {
        $category = Category::factory()->create();
        $product = Product::factory()->create([
            'category_id' => $category->id
        ]);

        $this->assertInstanceOf(Category::class, $product->category);
    }

    public function testProductHasMetatags()
    {
        $product = Product::factory()->create();
        $metatag = Metatag::factory()->create([
            'metatagable_id' => $product->id,
            'metatagable_type' => Product::class,
        ]);

        $this->assertInstanceOf(Metatag::class, $product->metatags);
        $this->assertEquals($metatag->id, $product->metatags->id);
    }
}
