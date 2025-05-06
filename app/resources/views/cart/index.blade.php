@extends('layout')

@section('content')

    @include('layouts.navigation')

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">

    <div class="container mt-5">
        <h1 class="mb-4 d-flex align-items-center">
            <i class="bi bi-cart4 me-2"></i> Ваша корзина
        </h1>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(empty($cart) || !is_array($cart) || count($cart) === 0)
            <div class="alert alert-info text-center">🧺 Ваша корзина пуста</div>
        @else

            <div class="table-responsive">
                <table class="table align-middle table-bordered table-hover shadow-sm rounded overflow-hidden">
                    <thead class="table-dark text-center">
                    <tr>
                        <th style="width: 180px;">Изображение</th>
                        <th>Название</th>
                        <th>Цена</th>
                        <th>Количество</th>
                        <th>Действия</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $total = 0; @endphp
                    @foreach($cart as $id => $item)
                        @php $total += $item['price'] * $item['quantity']; @endphp
                        <tr class="text-center align-middle">
                            <td>
                                <img src="{{ asset('storage/' . $item['image_url']) }}"
                                     class="img-fluid rounded shadow-sm"
                                     style="max-height: 140px; object-fit: cover;"
                                     alt="{{ $item['name'] }}">
                            </td>
                            <td class="fw-bold text-start">{{ $item['name'] }}</td>
                            <td class="text-success fw-bold">{{ number_format($item['price'], 2) }} ₽</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td class="d-flex justify-content-center gap-2">
                                <form action="{{ route('cart.add', $id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">+</button>
                                </form>
                                <form action="{{ route('cart.remove', $id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger">-</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-between align-items-center mt-4 flex-column flex-md-row gap-3">
                <h5 class="fw-bold mb-0">
                    💰 Общая сумма: <span class="text-primary">{{ number_format($total, 2) }} ₽</span>
                </h5>
                <div class="d-flex gap-2">
                    <form action="{{ route('cart.clear') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-warning btn-sm shadow-sm">
                            🧹 Очистить корзину
                        </button>
                    </form>

                    <form action="{{ route('payment.checkout') }}" method="GET">
                        <button type="submit" class="btn btn-primary btn-sm shadow-sm">
                            💳 Перейти к оплате
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>

@endsection
