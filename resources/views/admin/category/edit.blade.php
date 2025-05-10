@extends('admin.layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0"><i class="fas fa-edit"></i> Редактирование категории</h2>
            </div>

            <!-- Вывод ошибок валидации -->
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
                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Левая колонка - изображение -->
                        <div class="col-md-4">
                            <div class="text-center mb-3">
                                @if($category->image_path)
                                    <img src="{{ $category->image_url }}"
                                         class="img-thumbnail mb-3"
                                         alt="Изображение категории"
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
                                <label for="category-image">Новое изображение</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="category-image" name="category[image]">
                                    <label class="custom-file-label" for="category-image">Выберите файл</label>
                                </div>
                                <small class="form-text text-muted">JPG, PNG, SVG, WEBP (макс. 2MB)</small>
                            </div>
                        </div>

                        <!-- Правая колонка - основные поля -->
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="category-title">Название категории *</label>
                                <input type="text" class="form-control @error('category.title') is-invalid @enderror"
                                       id="category-title" name="category[title]"
                                       value="{{ old('category.title', $category->title) }}" required>
                                @error('category.title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="category-slug">Slug (URL) *</label>
                                <input type="text" class="form-control @error('category.slug') is-invalid @enderror"
                                       id="category-slug" name="category[slug]"
                                       value="{{ old('category.slug', $category->slug) }}" required>
                                @error('category.slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="form-text text-muted">Должен быть уникальным</small>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category-parent_id">Родительская категория</label>
                                        <select class="form-control @error('category.parent_id') is-invalid @enderror"
                                                id="category-parent_id" name="category[parent_id]">
                                            <option value="">-- Без родителя --</option>
                                            @foreach ($categories as $cat)
                                                @if($cat->id !== $category->id) {{-- Исключаем текущую категорию --}}
                                                <option value="{{ $cat->id }}"
                                                    {{ old('category.parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->title }} - {{ $cat->type }}
                                                </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        @error('category.parent_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="category-type">Тип категории *</label>
                                        <select class="form-control @error('category.type') is-invalid @enderror"
                                                id="category-type" name="category[type]" required>
                                            <option value="manufacturer" {{ old('category.type', $category->type) == 'manufacturer' ? 'selected' : '' }}>
                                                Марка (BMW, Mercedes)
                                            </option>
                                            <option value="model" {{ old('category.type', $category->type) == 'model' ? 'selected' : '' }}>
                                                Модель (X5, G-Class)
                                            </option>
                                            <option value="part" {{ old('category.type', $category->type) == 'part' ? 'selected' : '' }}>
                                                Запчасти (Тормоза, Диски)
                                            </option>
                                        </select>
                                        @error('category.type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category-description">Описание</label>
                        <textarea class="form-control @error('category.description') is-invalid @enderror"
                                  id="category-description" name="category[description]"
                                  rows="3">{{ old('category.description', $category->description) }}</textarea>
                        @error('category.description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category-content">Контент</label>
                        <textarea class="form-control @error('category.content') is-invalid @enderror"
                                  id="category-content" name="category[content]"
                                  rows="6">{{ old('category.content', $category->content) }}</textarea>
                        @error('category.content')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <hr>
                    <h5 class="mb-3"><i class="fas fa-search"></i> SEO Настройки</h5>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="meta-meta_h1">Meta H1</label>
                                <input type="text" class="form-control"
                                       id="meta-meta_h1" name="meta[meta_h1]"
                                       value="{{ old('meta.meta_h1', $category->metatags->meta_h1 ?? '') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="meta-meta_title">Meta Title</label>
                                <input type="text" class="form-control"
                                       id="meta-meta_title" name="meta[meta_title]"
                                       value="{{ old('meta.meta_title', $category->metatags->meta_title ?? '') }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="meta-meta_description">Meta Description</label>
                                <textarea class="form-control"
                                          id="meta-meta_description" name="meta[meta_description]"
                                          rows="1">{{ old('meta.meta_description', $category->metatags->meta_description ?? '') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-between border-top pt-3">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-arrow-left"></i> Отмена
                        </a>
                        <div>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Сохранить изменения
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Модальное окно для просмотра изображения -->
    @if($category->image_path)
        <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Просмотр изображения</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ Storage::url($category->image_path) }}" class="img-fluid" alt="Изображение категории">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
