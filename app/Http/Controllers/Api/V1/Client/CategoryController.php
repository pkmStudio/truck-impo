<?php

namespace App\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryModelResource;
use App\Http\Resources\Category\CategoryPartResource;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{

    /**
     * @param $brandSlug
     * @return array
     */
    public function showBrand($brandSlug): array
    {
        $category = Category::where('slug', $brandSlug)
            ->with(['children' => function($query) { $query->where('type', 'model');}])
            ->firstOrFail();
        return CategoryResource::make($category)->resolve();
    }

    /**
     * @param $brandSlug
     * @param $modelSlug
     * @return array
     */
    public function showModel($brandSlug, $modelSlug): array
    {
        $category = Category::where('slug', $modelSlug)
            ->whereHas('parent', fn ($query) => $query->where('slug', $brandSlug))
            ->with('parent.parts')
            ->firstOrFail();
        $category->setRelation('parts', $category->parent->parts);
        return CategoryModelResource::make($category)->resolve();
    }

    /**
     * @param $brandSlug
     * @param $partSlug
     * @return array
     */
    public function showPart($brandSlug, $partSlug): array
    {
        $parent = Category::where('slug', $brandSlug)->firstOrFail();
        $category = Category::where('slug', $partSlug)->where('parent_id', $parent->id)->with('products')->firstOrFail();
        return CategoryPartResource::make($category)->resolve();
    }
}
