<?php

namespace Tests\Feature\Requests\Admin\Category;

use App\Http\Requests\Admin\Category\StoreRequest;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\Rule;
use Tests\TestCase;

class StoreRequestTest extends TestCase
{
    use RefreshDatabase;

    public function testTitleIsRequired()
    {
        $request = new StoreRequest();
        $validator = validator(
            ['category.title' => null,],
            ['category.title' => $request->rules()['category.title']]
        );

        $this->assertTrue($validator->fails());
    }

    public function testSlugIsRequired()
    {
        $request = new StoreRequest();
        $validator = validator(
            ['category.slug' => null,],
            ['category.slug' => $request->rules()['category.slug']]
        );

        $this->assertTrue($validator->fails());
    }

    public function testTypeIsRequired()
    {
        $request = new StoreRequest();
        $validator = validator(
            ['category.type' => null,],
            ['category.type' => $request->rules()['category.type']]
        );

        $this->assertTrue($validator->fails());
    }

    public function testParentIdCanBeNull()
    {
        $request = new StoreRequest();
        $validator = validator(
            ['category.parent_id' => null,],
            ['category.parent_id' => $request->rules()['category.parent_id']]
        );

        $this->assertFalse($validator->fails());
    }

    public function testSlugMustBeUniqueOnlyInParentId()
    {
        $parent = Category::factory()->create();
        Category::factory()->create(['slug' => 'test-slug', 'parent_id' => $parent->id]);

        $request = new StoreRequest();

        $request->merge(['category.slug' => 'test-slug', 'category.parent_id' => $parent->id]);
        $validator = validator($request->all(), ['category.slug' => $request->rules()['category.slug']]);
        $this->assertTrue($validator->fails());

        $request->merge(['category.slug' => 'test-slug-unique', 'category.parent_id' => $parent->id]);
        $validator = validator($request->all(), ['category.slug' => $request->rules()['category.slug']]);
        $this->assertFalse($validator->fails());
    }

    public function testValidCategoryDataPassesValidation()
    {
        $request = new StoreRequest();
        $validator = validator([
            'category' => [
                'title' => 'Valid Category Title',
                'slug' => 'Valid-Category-Slug',
                'type' => 'model',
                'parent_id' => null,
            ]
        ], $request->rules());

        $this->assertFalse($validator->fails());
    }
}
