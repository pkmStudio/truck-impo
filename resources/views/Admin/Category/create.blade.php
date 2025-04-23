@extends('admin.layouts.main')

@section('content')
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        @php session()->forget('success'); @endphp
    @endif

    <div class="container mt-4">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h2 class="mb-0"><i class="fas fa-folder-plus"></i> Создание новой категории</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="category-title">Название категории <small class="text-muted">(уникальное)</small></label>
                        <input type="text" class="form-control" id="category-title" name="category[title]" value="{{ old('category.title') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="category-slug">Slug <small class="text-muted">(уникальный)</small></label>
                        <input type="text" class="form-control" id="category-slug" name="category[slug]" value="{{ old('category.slug') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="category-parent_id">Родительская категория</label>
                        <select class="form-control" id="category-parent_id" name="category[parent_id]">
                            <option value="">Без родителя</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="category-type">Тип категории <small class="text-muted">(обязательно)</small></label>
                        <select class="form-control" id="category-type" name="category[type]" required>
                            <option value="manufacturer">Марка (BMW, Mercedes)</option>
                            <option value="model">Модель трака (X5, G-Class)</option>
                            <option value="part">Запчасти (Тормоза, Диски)</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="category-image">Изображение<small class="text-muted">(необязательно)</small></label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="form-control" id="category-image" name="category[image]">
                                <label class="custom-file-label" for="category-image">Выберите изображение</label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="category-description">Описание <small class="text-muted">(необязательно)</small></label>
                        <textarea class="form-control" id="category-description" name="category[description]" rows="3">{{ old('category.description') }}</textarea>
                    </div>

                    <div class="form-group mt-3">
                        <label for="category-content">Контент <small class="text-muted">(необязательно)</small></label>
                        <textarea class="form-control" id="category-content" name="category[content]" rows="6">{{ old('category.content') }}</textarea>
                    </div>

                    <!-- 🔹 Метатеги -->
                    <hr>
                    <h4>SEO Метатеги</h4>

                    <div class="form-group">
                        <label for="meta-meta_h1">Meta H1</label>
                        <input type="text" class="form-control" id="meta-meta_h1" name="meta[meta_h1]" value="{{ old('meta.meta_h1') }}">
                    </div>

                    <div class="form-group">
                        <label for="meta-meta_title">Meta Title</label>
                        <input type="text" class="form-control" id="meta-meta_title" name="meta[meta_title]" value="{{ old('meta.meta_title') }}">
                    </div>

                    <div class="form-group">
                        <label for="meta-meta_description">Meta Description</label>
                        <textarea class="form-control" id="meta-meta_description" name="meta[meta_description]" rows="3">{{ old('meta.meta_description') }}</textarea>
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Назад
                        </a>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Сохранить категорию
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
