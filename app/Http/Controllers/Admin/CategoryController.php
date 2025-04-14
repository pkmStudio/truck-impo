<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use App\Services\Admin\CategoryService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request): View
    {
        $categories = Category::all()->sortBy('id');
        return view('admin.category.index', ['categories' => $categories]);
    }

    public function create(): View
    {
        $categories = Category::all()->sortBy('title');
        return view('admin.category.create', ['categories' => $categories]);
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->except('category.image');
        CategoryService::store($data);
        return redirect()->route('admin.categories.create');
    }

    public function edit(Category $category): View
    {
        $categories = Category::all()->sortBy('title');
        return view('admin.category.edit', ['category' => $category, 'categories' => $categories]);
    }

    public function update(Category $category, UpdateRequest $request): RedirectResponse
    {
        $data = $request->except('category.image');
        CategoryService::update($data, $category);
        return redirect()->route('admin.categories.index');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->delete();
        return redirect()->route('admin.categories.index');
    }
}
