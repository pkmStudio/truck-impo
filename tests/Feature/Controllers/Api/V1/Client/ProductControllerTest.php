<?php

namespace Tests\Feature\Controllers\Api\V1\Client;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShowProductByArticleIsCorrect()
    {
        $product = Product::factory()->create(['article' => 1345]);
        $response = $this->getJson(route('v1.client.products.show', ['article' => 1345]));
        $response->assertStatus(200);
        $response->assertJson([
            'article' => 1345
        ]);
    }

    public function testShowProductReturns404ForInvalidArticle()
    {
        $product = Product::factory()->create(['article' => 1345]);
        $response = $this->getJson(route('v1.client.products.show', ['article' => 1234]));
        $response->assertStatus(404);
    }
}
