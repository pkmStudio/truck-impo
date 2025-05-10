<?php

namespace Tests\Feature\Admin;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BrandControllerTest extends TestCase
{
    use RefreshDatabase;
//    public function test_admin_can_view_brands_page()
//    {
////        $response = $this->get(route('admin.brands.index'));
////        $response->assertStatus(200);
////        $response->assertViewIs('admin.brand.index');
////        $response->assertViewHas('brands');
//    }

    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }
}
