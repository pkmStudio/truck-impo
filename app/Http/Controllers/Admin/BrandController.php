<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brand\StoreRequest;
use App\Http\Requests\Admin\Brand\UpdateRequest;
use App\Models\Brand;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brand::all();
//        return view('admin.brand.index', ['brands' => $brands]);
        return \response()->json($brands);
    }

    public function create(): View
    {
        return view('admin.brand.create');
    }

    public function store(StoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Brand::create($data);
        return redirect()->route('admin.brands.create');
    }

    public function edit(Brand $brand): View
    {
        return view('admin.brand.edit', ['brand' => $brand]);
    }

    public function update(Brand $brand, UpdateRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $brand->update($data);
        return redirect()->route('admin.brands.index');
    }

    public function destroy(Brand $brand): RedirectResponse
    {
        $brand->delete();
        return redirect()->route('admin.brands.index');
    }
}
