@extends('admin.layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0"><i class="fas fa-edit"></i> Редактирование продукта</h2>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show m-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card-body">
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Левая колонка - изображение -->
                        <div class="col-md-4">
                            <div class="text-center mb-3">
                                @if($product->image_path)
                                    <img src="{{ Storage::url($product->image_path) }}"
                                         class="img-thumbnail mb-3"
                                         alt="Изображение продукта"
                                         style="max-height: 200px; cursor: pointer;"
                                         data-toggle="modal"
                                         data-target="#imageModal">
                                @else
                                    <div class="bg-light p-4 text-muted rounded mb-3">
                                        <i class="fas fa-image fa-3x mb-2"></i>
                                        <p class="mb-0">Изображение отсутствует</p>
                                    </div>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="product-image">Новое изображение</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="product-image" name="product[image]">
                                    <label class="custom-file-label" for="product-image">Выберите файл</label>
                                </div>
                                <small class="form-text text-muted">JPG, PNG, SVG, WEBP (макс. 2MB)</small>
                            </div>
                        </div>

                        <!-- Правая колонка - основные поля -->
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="product-title">Название продукта <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('product.title') is-invalid @enderror"
                                       id="product-title" name="product[title]"
                                       value="{{ old('product.title', $product->title) }}" required>
                                @error('product.title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="product-article">Артикул <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('product.article') is-invalid @enderror"
                                       id="product-article" name="product[article]"
                                       value="{{ old('product.article', $product->article) }}" required>
                                @error('product.article')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product-brand_id">Бренд <span class="text-danger">*</span></label>
                                        <select class="form-control @error('product.brand_id') is-invalid @enderror"
                                                id="product-brand_id" name="product[brand_id]" required>
                                            @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}"
                                                    {{ old('product.brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>
                                                    {{ $brand->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('product.brand_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product-category_id">Категория <span class="text-danger">*</span></label>
                                        <select class="form-control @error('product.category_id') is-invalid @enderror"
                                                id="product-category_id" name="product[category_id]" required>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('product.category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->parent->title }} - {{ $category->title }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('product.category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product-price">Цена <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('product.price') is-invalid @enderror"
                                       id="product-price" name="product[price]"
                                       value="{{ old('product.price', $product->price) }}" required>
                                @error('product.price')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product-quantity">Цена <span class="text-danger">*</span></label>
                                <input type="number" class="form-control @error('product.quantity') is-invalid @enderror"
                                       id="product-quantity" name="product[quantity]"
                                       value="{{ old('product.quantity', $product->quantity) }}" required min="0">
                                @error('product.quantity')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="product-delivery">Срок доставки</label>
                                <input type="text" class="form-control @error('product.delivery') is-invalid @enderror"
                                       id="product-delivery" name="product[delivery]"
                                       value="{{ old('product.delivery', $product->delivery) }}">
                                @error('product.delivery')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="product-description">Описание</label>
                        <textarea class="form-control @error('product.description') is-invalid @enderror"
                                  id="product-description" name="product[description]"
                                  rows="3">{{ old('product.description', $product->description) }}</textarea>
                        @error('product.description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>
                    <h5 class="mb-3"><i class="fas fa-search"></i> SEO Настройки</h5>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="meta-meta_h1">Meta H1</label>
                            <input type="text" class="form-control" id="meta-meta_h1" name="meta[meta_h1]"
                                   value="{{ old('meta.meta_h1', $product->metatags->meta_h1 ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="meta-meta_title">Meta Title</label>
                            <input type="text" class="form-control" id="meta-meta_title" name="meta[meta_title]"
                                   value="{{ old('meta.meta_title', $product->metatags->meta_title ?? '') }}">
                        </div>
                        <div class="col-md-4">
                            <label for="meta-meta_description">Meta Description</label>
                            <textarea class="form-control" id="meta-meta_description" name="meta[meta_description]"
                                      rows="1">{{ old('meta.meta_description', $product->metatags->meta_description ?? '') }}</textarea>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-between border-top pt-3">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Отмена
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Сохранить изменения
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
