<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brand\StoreRequest;
use App\Http\Requests\Admin\Brand\UpdateRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brand::all();
        return view('admin.brand.index', ['brands' => $brands]);
    }

    public function show(Brand $brand)
    {

    }


    public function create()
    {
        return view('admin.brand.create');
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Brand::firstOrCreate($data);
        return redirect()->route('admin.brands.create');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brand.edit', ['brand' => $brand]);
    }

    public function update(Brand $brand, UpdateRequest $request)
    {
        $data = $request->validated();
        $brand->update($data);
        return redirect()->route('admin.brands.index');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect()->route('admin.brands.index');
    }
}
