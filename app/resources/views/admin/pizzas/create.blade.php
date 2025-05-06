@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Добавить пиццу</h1>

        <form action="{{ route('admin.pizzas.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label class="form-label">Название</label>
                <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Описание</label>
                <textarea name="description" class="form-control" required maxlength="1000">{{ old('description') }}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Цена</label>
                <input type="number" name="price" class="form-control" required min="0" value="{{ old('price') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Фото</label>
                <input type="file" name="image" class="form-control">
            </div>

            <div class="mb-3">
                <label for="type_id" class="form-label">Тип пиццы</label>
                <select name="type_id" id="type_id" class="form-select" required>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-success">Добавить</button>
        </form>
    </div>
@endsection
