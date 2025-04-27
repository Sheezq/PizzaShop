@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="section-title">История заказов</h1>

        @if($orders->isEmpty())
            <div class="alert alert-info text-center">
                У вас пока нет заказов.
            </div>
        @else
            <ul class="list-group">
                @foreach($orders as $order)
                    <li class="list-group-item">
                        Заказ #{{ $order->id }} - {{ $order->total_price }} ₽ - {{ $order->created_at->format('d.m.Y H:i') }}
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
