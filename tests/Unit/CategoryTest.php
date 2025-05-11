<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Models\Metatag;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function testCategoryBelongsToParent()
    {
        $parentCategory = Category::factory()->create();
        $category = Category::factory()->create(['parent_id' => $parentCategory->id]);

        $this->assertEquals($parentCategory->id, $category->parent->id);
        $this->assertInstanceOf(Category::class, $category->parent);
    }

    public function testCategoryHasManyChildren()
    {
        $parentCategory = Category::factory()->create();
        Category::factory()->count(2)->create(['parent_id' => $parentCategory->id]);

        $this->assertCount(2, $parentCategory->children);
        $this->assertInstanceOf(Category::class, $parentCategory->children->first());
    }

    public function testCategoryHasManyParts()
    {
        $parentCategory = Category::factory()->create();

        // Создаём дочерние категории с `type = part`
        Category::factory()->count(2)->create([
            'parent_id' => $parentCategory->id,
            'type' => 'part',
        ]);

        // Создаём дочернюю категорию с `type = model`
        $model = Category::factory()->create([
            'parent_id' => $parentCategory->id,
            'type' => 'model',
        ]);

        $this->assertCount(2, $parentCategory->parts);
        $this->assertFalse($parentCategory->parts->contains($model));
        $this->assertInstanceOf(Category::class, $parentCategory->parts->first());
    }

    public function testCategoryHasManyProducts()
    {
        $parentCategory = Category::factory()->create();
        Product::factory()->count(2)->create(['category_id' => $parentCategory->id]);

        $this->assertCount(2, $parentCategory->products);
        $this->assertInstanceOf(Product::class, $parentCategory->products->first());
    }

    public function testCategoryHasMetatags()
    {
        $category = Category::factory()->create();
        $metatag = Metatag::factory()->create([
            'metatagable_id' => $category->id,
            'metatagable_type' => Category::class,
        ]);

        $this->assertInstanceOf(Metatag::class, $category->metatags);
        $this->assertEquals($metatag->id, $category->metatags->id);
    }
}
