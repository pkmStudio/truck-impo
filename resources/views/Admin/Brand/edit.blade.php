@extends('admin.layouts.main')

@section('content')
    <div class="container mt-4">
        <h2>Редактирование бренда</h2>

        <form action="{{ route('admin.brands.update', $brand->id) }}" method="POST">
            @csrf
            @method('PATCH')

            <div class="form-group">
                <label for="title">Название бренда</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $brand->title) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Описание</label>
                <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $brand->description) }}</textarea>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Сохранить изменения
            </button>
            <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Назад
            </a>
        </form>
    </div>
@endsection
