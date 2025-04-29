@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Добавить пиццу</h1>

        <form action="{{ route('admin.pizzas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Название</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Описание</label>
                <textarea name="description" class="form-control" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Цена</label>
                <input type="number" name="price" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Фото</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Тип пиццы</label>
                <select name="type" class="form-select" required>
                    <option value="">-- Выберите тип --</option>
                    <option value="meat">С мясом</option>
                    <option value="fish">Рыбная</option>
                    <option value="veggie">Вегетарианская</option>
                </select>
            </div>


            <button type="submit" class="btn btn-success">Добавить</button>
        </form>
    </div>
@endsection
