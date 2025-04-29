@extends('layouts.app')

@section('content')
    <div class="container d-flex justify-content-center align-items-center min-vh-100 bg-light">
        <div class="card p-5 shadow-lg text-center">
            <h1 class="text-success mb-3">Спасибо, {{ $name }}! 🎉</h1>
            <p class="mb-2">Ваш заказ на сумму <strong>{{ $amount }} ₽</strong> успешно принят.</p>
            <p class="mb-4">Способ оплаты: <strong>
                    @if ($payment === 'card_online')
                        Карта онлайн
                    @elseif ($payment === 'cash')
                        Наличные
                    @else
                        Карта курьеру
                    @endif
                </strong></p>
            <a href="{{ route('home') }}" class="btn btn-success">На главную</a>
        </div>
    </div>
@endsection
