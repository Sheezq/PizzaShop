<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h1 class="text-center">Добро пожаловать на сайт пиццерии!</h1>

    <!-- Форма поиска с выравниванием по правому краю -->
    <div class="row justify-content-end">
        <div class="col-md-6">
            <form method="GET" action="{{ route('search') }}" class="search-form">
                <div class="input-group mb-3">
                    <input type="text" class="search-input form-control" name="query" placeholder="Поиск пиццы" value="{{ request('query') }}">
                    <button class="search-btn btn btn-primary" type="submit">Поиск</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Авторизация -->
    @if (Auth::check())
        <p>Привет, {{ Auth::user()->name }}!</p>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-danger">Выйти</button>
        </form>
    @else
        <p>Вы не авторизованы.</p>
        <a href="{{ route('login') }}" class="btn btn-primary">Войти</a>
        <a href="{{ route('register') }}" class="btn btn-success">Зарегистрироваться</a>
    @endif

    @if(Auth::check() && Auth::user()->hasRole('admin'))
        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">Перейти в админ-панель</a>
    @else
        <p>Вы не администратор.</p>
    @endif

    <h2 class="mt-5">Список Пицц</h2>
    <div class="row">
        @if($pizzas->isEmpty())
            <div class="col-12">
                <p>Пиццы не найдены.</p>
            </div>
        @else
            @foreach ($pizzas as $pizza)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <img src="{{ $pizza->image_url }}" class="img-fluid" alt="{{ $pizza->name }}">

                        <div class="card-body">
                            <h5 class="card-title">{{ $pizza->name }}</h5>
                            <p class="card-text">{{ $pizza->description }}</p>
                            <p class="card-text">Цена: {{ $pizza->price }} ₽</p>
                            <form action="{{ route('cart.add', $pizza->id) }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-warning">В корзину</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
