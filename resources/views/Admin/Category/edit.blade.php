@extends('admin.layouts.main')

@section('content')
    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0"><i class="fas fa-edit"></i> Редактирование категории</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <div class="row">
                        <!-- 🔹 Левая колонка - изображение -->
                        <div class="col-md-4 text-center">
                            <!-- 🔹 Кликабельное изображение, открывающее модальное окно -->
                            @if($category->image_url)
                                <img src="{{ $category->image_url }}" class="img-thumbnail mb-3" alt="Изображение категории" data-toggle="modal" data-target="#imageModal">
                            @else
                                <p>Изображение пока не установлено</p>
                            @endif

                            <div class="form-group">
                                <label for="category-image">Заменить изображение <small class="text-muted">(необязательно)</small></label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="category-image" name="category[image]">
                                        <label class="custom-file-label" for="category-image">Выберите изображение</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- 🔹 Правая колонка - три поля -->
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="category-title">Название категории <small class="text-muted">(уникальное)</small></label>
                                <input type="text" class="form-control" id="category-title" name="category[title]" value="{{ old('category.title', $category->title) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="category-slug">Slug <small class="text-muted">(уникальный)</small></label>
                                <input type="text" class="form-control" id="category-slug" name="category[slug]" value="{{ old('category.slug', $category->slug) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="category-parent_id">Родительская категория</label>
                                <select class="form-control" id="category-parent_id" name="category[parent_id]">
                                    <option value="">Без родителя</option>
                                    @foreach ($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ $category->parent_id == $cat->id ? 'selected' : '' }}>
                                            {{ $cat->title }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <!-- 🔹 Остальные поля - на всю ширину -->
                    <hr>
                    <div class="form-group">
                        <label for="category-description">Описание</label>
                        <textarea class="form-control" id="category-description" name="category[description]" rows="3">{{ old('category.description', $category->description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="category-content">Контент</label>
                        <textarea class="form-control" id="category-content" name="category[content]" rows="6">{{ old('category.content', $category->content) }}</textarea>
                    </div>

                    <!-- 🔹 Метатеги -->
                    <hr>
                    <h4>SEO Метатеги</h4>

                    <div class="form-group">
                        <label for="meta-meta_h1">Meta H1</label>
                        <input type="text" class="form-control" id="meta-meta_h1" name="meta[meta_h1]" value="{{ old('meta.meta_h1', $category->metatags->meta_h1 ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label for="meta-meta_title">Meta Title</label>
                        <input type="text" class="form-control" id="meta-meta_title" name="meta[meta_title]" value="{{ old('meta.meta_title', $category->metatags->meta_title ?? '') }}">
                    </div>

                    <div class="form-group">
                        <label for="meta-meta_description">Meta Description</label>
                        <textarea class="form-control" id="meta-meta_description" name="meta[meta_description]" rows="3">{{ old('meta.meta_description', $category->metatags->meta_description ?? '') }}</textarea>
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Назад
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Сохранить изменения
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- 🔹 Модальное окно для увеличения изображения -->
    <div class="modal fade" id="imageModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <img src="{{ $category->image_url }}" class="img-fluid" alt="Увеличенное изображение">
                </div>
            </div>
        </div>
    </div>
@endsection
