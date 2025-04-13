@extends('admin.layouts.main')

@section('content')
    <div class="container mt-4">
        <h2>Создание нового бренда</h2>

        <form action="{{ route('admin.brands.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Название бренда</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="description">Описание</label>
                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
            </div>

            <button type="submit" class="btn btn-success">
                <i class="fas fa-save"></i> Сохранить
            </button>
            <a href="{{ route('admin.brands.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Назад
            </a>
        </form>
    </div>
@endsection
