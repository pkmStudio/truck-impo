<?php

namespace Tests\Feature\Requests\Admin\Brand;

use App\Http\Requests\Admin\Brand\StoreRequest;
use App\Models\Brand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class StoreRequestTest extends TestCase
{
    use RefreshDatabase;

    public function testTitleIsRequired()
    {
        $request = new StoreRequest();
        $validator = validator(['title' => null], $request->rules());

        $this->assertTrue($validator->fails());
    }

    public function testTitleMustBeUnique()
    {
        Brand::factory()->create(['title' => 'Toyota']);

        $request = new StoreRequest();
        $validator = validator(['title' => 'Toyota'], $request->rules());

        $this->assertTrue($validator->fails());
    }

    public function testValidBrandDataPassesValidation()
    {
        $request = new StoreRequest();
        $validator = validator([
            'title' => 'Valid Brand',
            'description' => 'Some description'
        ], $request->rules());

        $this->assertFalse($validator->fails());
    }
}
