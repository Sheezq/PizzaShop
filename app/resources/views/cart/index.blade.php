@extends('layout')

@section('content')
    <h1>Ваша корзина</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(empty($cart))
        <p>Корзина пуста</p>
    @else
        <table class="table">
            <thead>
            <tr>
                <th>Изображение</th>
                <th>Название</th>
                <th>Цена</th>
                <th>Количество</th>
                <th>Действия</th>
            </tr>
            </thead>
            <tbody>
            @foreach($cart as $id => $item)
                <tr>
                    <td><img src="{{ asset('storage/' . $item['image_url']) }}" width="50"></td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['price'] }} ₽</td>
                    <td>{{ $item['quantity'] }}</td>
                    <td>
                        <form action="{{ route('cart.add', $id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">+</button>
                        </form>
                        <form action="{{ route('cart.remove', $id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">-</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-warning">Очистить корзину</button>
        </form>
    @endif
@endsection
