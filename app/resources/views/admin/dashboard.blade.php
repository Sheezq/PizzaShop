@extends('admin.layout')

@section('content')
    <h1>Добро пожаловать в админ-панель!</h1>

    <a href="{{ route('admin.pizzas.index') }}" class="btn btn-primary">Управление пиццами</a>
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Управление пользователями</a>
@endsection
