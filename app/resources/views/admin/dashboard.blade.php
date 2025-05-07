@extends('admin.layout')

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-4 text-primary">Добро пожаловать в админ-панель!</h1>

        <!-- Секция с кнопками управления -->
        <div class="row justify-content-center">
            <!-- Управление пиццами -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg rounded">
                    <div class="card-body text-center">
                        <h5 class="card-title">Управление пиццами</h5>
                        <p>Добавляйте, редактируйте и удаляйте пиццы.</p>
                        <a href="{{ route('admin.pizzas.index') }}" class="btn btn-danger btn-lg">
                            <i class="bi bi-pizza-slice"></i> Перейти к пиццам
                        </a>
                    </div>
                </div>
            </div>

            <!-- Управление пользователями -->
            <div class="col-md-4 mb-4">
                <div class="card shadow-lg rounded">
                    <div class="card-body text-center">
                        <h5 class="card-title">Управление пользователями</h5>
                        <p>Просматривайте и редактируйте пользователей.</p>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-success btn-lg">
                            <i class="bi bi-person-circle"></i> Перейти к пользователям
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
