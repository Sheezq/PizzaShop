<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Меню - Пиццерия</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>

@include('layouts.navigation')

<div class="container mt-5">
    <h2 class="section-title text-center mb-4">Меню пицц</h2>

    <form method="GET" action="{{ route('search') }}" class="d-flex mx-auto mb-5" style="max-width: 400px;">
        <input
            type="text"
            name="query"
            class="form-control me-2"
            placeholder="Поиск пиццы"
            value="{{ request('query') }}"
        >
        <button class="btn btn-primary" type="submit">Поиск</button>
    </form>

    <div class="row g-4">
        @if($pizzas->isEmpty())
            <div class="col-12 text-center">
                <p>Пиццы не найдены.</p>
            </div>
        @else
            @foreach ($pizzas as $pizza)
                <div class="col-sm-12 col-md-6 col-lg-4 d-flex">
                    <div class="pizza-card card flex-fill text-center">
                        <img src="{{ $pizza->image_url }}" class="pizza-image card-img-top" alt="{{ $pizza->name }}">

                        <div class="card-body d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="pizza-title card-title">{{ $pizza->name }}</h5>
                                <p class="pizza-price card-text">Цена: {{ number_format($pizza->price, 2) }} ₽</p>
                            </div>

                            <button
                                class="btn btn-warning w-100 mt-3"
                                data-bs-toggle="modal"
                                data-bs-target="#pizzaModal{{ $pizza->id }}">
                                Подробнее
                            </button>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="pizzaModal{{ $pizza->id }}" tabindex="-1" aria-labelledby="pizzaModalLabel{{ $pizza->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="pizzaModalLabel{{ $pizza->id }}">{{ $pizza->name }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Закрыть"></button>
                            </div>

                            <div class="modal-body text-center">
                                <img src="{{ $pizza->image_url }}" alt="{{ $pizza->name }}" class="img-fluid mb-3" style="max-height: 300px; object-fit: cover;">
                                <p><strong>Описание:</strong> {{ $pizza->description }}</p>
                                <p><strong>Цена:</strong> {{ number_format($pizza->price, 2) }} ₽</p>
                            </div>

                            <div class="modal-footer d-flex flex-column gap-2">
                                <form action="{{ route('cart.add', $pizza->id) }}" method="POST" class="w-100">
                                    @csrf
                                    <button type="submit" class="btn btn-warning w-100">Добавить в корзину</button>
                                </form>
                                <button type="button" class="btn btn-secondary w-100" data-bs-dismiss="modal">Закрыть</button>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
</div>

@include('layouts.footer')


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
