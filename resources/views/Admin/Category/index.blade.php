@extends('admin.layouts.main')

@section('content')
    <div class="container mt-4">
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Добавить Категорию
        </a>

        <table class="table table-bordered">
            <thead style="background-color: #007bff; color: #fff;">
            <tr>
                <th>ID</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->title }}</td>
                    <td>{{ $category->description }}</td>
                    <td>
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i>
                        </a>

                        <!-- Кнопка удаления с модальным окном -->
                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal" data-action="{{ route('admin.categories.destroy', $category->id) }}" onclick="setDeleteAction(this)">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <!-- 🔹 Модальное окно для подтверждения удаления -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <form id="deleteForm" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Удаление категории</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Закрыть">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Вы точно хотите удалить эту категорию?</p>
                        <p>Это может также удалить все товары этой категории.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                        <button type="submit" class="btn btn-danger">Удалить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- 🔹 JavaScript для установки ID удаляемого бренда -->
    <script>
        function setDeleteAction(button) {
            document.getElementById('deleteForm').action = button.getAttribute('data-action');
        }
    </script>
@endsection
