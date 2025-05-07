@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="section-title">История заказов</h1>

        @if($orders->isEmpty())
            <div class="alert alert-info text-center">
                У вас пока нет заказов.
            </div>
        @else
            <div class="row row-cols-1 row-cols-md-2 g-4">
                @foreach($orders as $order)
                    <div class="col">
                        <div class="card shadow-sm border-0 h-100">
                            <div class="card-body">
                                <h5 class="card-title mb-2">📦 Заказ #{{ $order->id }}</h5>
                                <p class="card-text mb-1">
                                    <strong>Сумма:</strong> <span class="text-success">{{ number_format($order->total_price, 2) }} $</span>
                                </p>
                                <p class="card-text mb-1">
                                    <strong>Дата:</strong> {{ $order->created_at->format('d.m.Y H:i') }}
                                </p>
                                @if(isset($order->status))
                                    <p class="card-text mb-2">
                                        <strong>Статус:</strong>
                                        <span class="badge bg-{{ $order->status === 'завершён' ? 'success' : 'secondary' }}">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </p>
                                @endif

                                {{-- Состав заказа --}}
                                @if(!empty($order->items))
                                    <hr>
                                    <p class="fw-bold mb-2">Состав заказа:</p>
                                    <ul class="list-group list-group-flush">
                                        @foreach($order->items as $item)
                                            <li class="">
                                                {{ $item['name'] }}
                                                <span class="badge bg-primary rounded-pill">
                                                    {{ $item['quantity'] }} × {{ number_format($item['price'], 2) }} $
                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

@endsection
