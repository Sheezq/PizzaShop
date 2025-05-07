@extends('layouts.app')

@section('content')
    <div class="container py-5 d-flex justify-content-center">
        <div class=" shadow rounded-4 p-5" style="max-width: 600px; width: 100%;">
            <h1 class="text-center fw-bold text-success mb-4" style="font-size: 2.5rem;">
                Спасибо, {{ $name }}! 🎉
            </h1>

            <div class="text-white rounded py-3 px-4 mb-3 text-center">
                Ваш заказ на сумму <strong>{{ $amount }} $</strong> успешно принят.
            </div>

            <div class="text-white rounded py-3 px-4 mb-4 text-center">
                Способ оплаты:
                <strong>
                    @if ($payment === 'card_online')
                        Карта онлайн
                    @elseif ($payment === 'cash')
                        Наличные
                    @else
                        Карта курьеру
                    @endif
                </strong>
            </div>

            <div class="text-center">
                <a href="{{ route('home') }}" class="btn btn-success px-4 py-2 fw-bold rounded-pill">
                    На главную
                </a>
            </div>
        </div>
    </div>

@endsection
