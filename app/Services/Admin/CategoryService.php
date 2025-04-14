<?php

namespace App\Services\Admin;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryService
{
    public static function store(array $data): Category
    {
        try {
            DB::beginTransaction();
            $category = Category::create($data['category']);
            $category->metatags()->create($data['meta']);
            session()->put('success', 'Категория успешно добавлена!');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500, $e->getMessage());
        }

        return $category;
    }

    public static function update(array $data, Category $category): Category
    {
        try {
            DB::beginTransaction();
            $category->update($data['category']);
            $category->metatags()->update($data['meta']);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500, $e->getMessage());
        }

        return $category;
    }
}
