<!-- resources/views/welcome.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
    <h1 class="text-center">Добро пожаловать на сайт пиццерии!</h1>

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

    <h2 class="mt-5">Список Пицц</h2>
    <div class="row">
        @if($pizzas->isEmpty())
            <div class="col-12">
                <p>Пиццы в меню отсутствуют.</p>
            </div>
        @else
            @foreach ($pizzas as $pizza)
                <div class="col-md-4">
                    <div class="card mb-3">
                        <!-- Поставь свою картинку или логику отображения -->
                        <img src="{{ $pizza->image_url }}" class="card-img-top" alt="{{ $pizza->name }}" onerror="this.onerror=null;this.src='https://via.placeholder.com/150';">
                        <div class="card-body">
                            <h5 class="card-title">{{ $pizza->name }}</h5>
                            <p class="card-text">{{ $pizza->description }}</p>
                            <p class="card-text">Цена: {{ $pizza->price }} ₽</p>
                            <a href="{{ route('order', $pizza->id) }}" class="btn btn-success">Заказать</a>
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
