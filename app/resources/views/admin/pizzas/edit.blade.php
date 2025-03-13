@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Редактировать пиццу</h1>

        <form action="{{ route('admin.pizzas.update', $pizza->id) }}" method="POST" enctype="multipart/form-data">
            @csrf @method('PUT')

            <div class="mb-3">
                <label class="form-label">Название</label>
                <input type="text" name="name" class="form-control" value="{{ $pizza->name }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Описание</label>
                <textarea name="description" class="form-control" required>{{ $pizza->description }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Цена</label>
                <input type="number" name="price" class="form-control" value="{{ $pizza->price }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Фото</label>
                <input type="file" name="image" class="form-control">
                @if($pizza->image_url)
                    <img src="{{ asset($pizza->image_url) }}" width="100" class="mt-2">
                @endif
            </div>

            <button type="submit" class="btn btn-success">Сохранить</button>
        </form>
    </div>
@endsection
