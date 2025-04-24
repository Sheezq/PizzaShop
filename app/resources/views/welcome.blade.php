<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Главная страница</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

@include('layouts.navigation')

<div class="container mt-5">

    <h2 class="section-title">Список Пицц</h2>

    <div class="row g-4">
        @if($pizzas->isEmpty())
            <div class="col-12">
                <p>Пиццы не найдены.</p>
            </div>
        @else
            @foreach ($pizzas as $pizza)
                <div class="col-sm-12 col-md-6 col-lg-4 d-flex">
                    <div class="pizza-card card flex-fill">
                        <img src="{{ $pizza->image_url }}" class="pizza-image card-img-top" alt="{{ $pizza->name }}">

                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="pizza-title card-title">{{ $pizza->name }}</h5>
                                <p class="pizza-description card-text">{{ $pizza->description }}</p>
                                <p class="pizza-price card-text">Цена: {{ number_format($pizza->price, 2) }} ₽</p>
                            </div>

                            <form action="{{ route('cart.add', $pizza->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-warning w-100 mt-3">В корзину</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
