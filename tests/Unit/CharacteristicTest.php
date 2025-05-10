<?php

namespace Tests\Unit;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Characteristic;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CharacteristicTest extends TestCase
{
    use RefreshDatabase;

    public function testCharacteristicBelongsToProduct()
    {
        $product = Product::factory()->create();
        $characteristic = Characteristic::factory()->create([
            'product_id' => $product->id,
        ]);

        $this->assertEquals($product->id, $characteristic->product->id);
        $this->assertInstanceOf(Product::class, $characteristic->product);
    }
}
