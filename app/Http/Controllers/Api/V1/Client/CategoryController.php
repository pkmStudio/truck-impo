<?php

namespace App\Http\Controllers\Api\V1\Client;

use App\Http\Controllers\Controller;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{

    public function show(Category $category)
    {
        return CategoryResource::make($category)->resolve();
    }
}
