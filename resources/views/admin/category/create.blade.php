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

            <!-- Общий блок ошибок -->
            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show mx-3 mt-3">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Закрыть">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="card-body">
                <form action="{{ route('admin.categories.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="category-title">Название категории <small class="text-muted">(уникальное)</small></label>
                        <input type="text" class="form-control @error('category.title') is-invalid @enderror"
                               id="category-title" name="category[title]"
                               value="{{ old('category.title') }}" required>
                        @error('category.title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category-slug">Slug <small class="text-muted">(уникальный)</small></label>
                        <input type="text" class="form-control @error('category.slug') is-invalid @enderror"
                               id="category-slug" name="category[slug]"
                               value="{{ old('category.slug') }}" required>
                        @error('category.slug')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category-parent_id">Родительская категория</label>
                        <select class="form-control @error('category.parent_id') is-invalid @enderror"
                                id="category-parent_id" name="category[parent_id]">
                            <option value="">Без родителя</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category.parent_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('category.parent_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category-type">Тип категории <small class="text-muted">(обязательно)</small></label>
                        <select class="form-control @error('category.type') is-invalid @enderror"
                                id="category-type" name="category[type]" required>
                            <option value="manufacturer" {{ old('category.type') == 'manufacturer' ? 'selected' : '' }}>
                                Марка (BMW, Mercedes)
                            </option>
                            <option value="model" {{ old('category.type') == 'model' ? 'selected' : '' }}>
                                Модель трака (X5, G-Class)
                            </option>
                            <option value="part" {{ old('category.type') == 'part' ? 'selected' : '' }}>
                                Запчасти (Тормоза, Диски)
                            </option>
                        </select>
                        @error('category.type')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="category-image">Изображение<small class="text-muted">(необязательно)</small></label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="form-control @error('category.image') is-invalid @enderror"
                                       id="category-image" name="category[image]">
                                <label class="custom-file-label" for="category-image">Выберите изображение</label>
                            </div>
                        </div>
                        @error('category.image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <small class="form-text text-muted">Допустимые форматы: jpg, jpeg, png, gif, svg, webp</small>
                    </div>

                    <div class="form-group">
                        <label for="category-description">Описание <small class="text-muted">(необязательно)</small></label>
                        <textarea class="form-control @error('category.description') is-invalid @enderror"
                                  id="category-description" name="category[description]"
                                  rows="3">{{ old('category.description') }}</textarea>
                        @error('category.description')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="category-content">Контент <small class="text-muted">(необязательно)</small></label>
                        <textarea class="form-control @error('category.content') is-invalid @enderror"
                                  id="category-content" name="category[content]"
                                  rows="6">{{ old('category.content') }}</textarea>
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
                                <input type="text" class="form-control @error('meta.meta_h1') is-invalid @enderror"
                                       id="meta-meta_h1" name="meta[meta_h1]"
                                       value="{{ old('meta.meta_h1') }}">
                                @error('meta.meta_h1')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="meta-meta_title">Meta Title</label>
                                <input type="text" class="form-control @error('meta.meta_title') is-invalid @enderror"
                                       id="meta-meta_title" name="meta[meta_title]"
                                       value="{{ old('meta.meta_title') }}">
                                @error('meta.meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="meta-meta_description">Meta Description</label>
                                <textarea class="form-control @error('meta.meta_description') is-invalid @enderror"
                                          id="meta-meta_description" name="meta[meta_description]"
                                          rows="1">{{ old('meta.meta_description') }}</textarea>
                                @error('meta.meta_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-between border-top pt-3">
                        <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary">
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

@push('scripts')
    <script>
        // Показываем имя выбранного файла
        document.getElementById('category-image').addEventListener('change', function(e) {
            var fileName = e.target.files[0]?.name || 'Выберите изображение';
            e.target.nextElementSibling.innerText = fileName;
        });
    </script>
@endpush
