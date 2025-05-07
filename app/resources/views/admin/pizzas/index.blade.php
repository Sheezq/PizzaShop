@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Управление пиццами</h1>

        <a href="{{ route('admin.pizzas.create') }}" class="btn btn-success mb-3">Добавить пиццу</a>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table">
            <thead>
            <tr>
                <th>Фото</th>
                <th>Название</th>
                <th>Описание</th>
                <th>Цена</th>
                <th>Тип</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pizzas as $pizza)
                <tr>
                    <td><img src="{{ asset($pizza->image_url) }}" width="80"></td>
                    <td>{{ $pizza->name }}</td>
                    <td>{{ $pizza->description }}</td>
                    <td>{{ $pizza->price }} $</td>
                    <td>
                        @if(is_object($pizza->type) && $pizza->type->name)
                            {{ $pizza->type->name }}
                        @else
                            -
                        @endif
                    </td>

                    <td>
                        <a href="{{ route('admin.pizzas.edit', $pizza->id) }}" class="btn btn-warning btn-sm">Редактировать</a>
                        <form action="{{ route('admin.pizzas.destroy', $pizza->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Удалить?')">Удалить</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
