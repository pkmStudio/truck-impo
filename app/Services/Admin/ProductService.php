<?php

namespace App\Services\Admin;

use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductService
{
    public static function store(array $data): Product
    {
        try {
            DB::beginTransaction();
            $product = Product::create($data['product']);
            $product->metatags()->create($data['meta']);
            session()->put('success', 'Товар успешно добавлен!');
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500, $e->getMessage());
        }

        return $product;
    }

    public static function update(array $data, Product $product): Product
    {
        try {
            DB::beginTransaction();
            $product->update($data['product']);
            $product->metatags()->updateOrCreate($data['meta']);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            abort(500, $e->getMessage());
        }

        return $product;
    }
}
