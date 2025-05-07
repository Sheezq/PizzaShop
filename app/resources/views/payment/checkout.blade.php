@extends('layout')

@section('content')

    @include('layouts.navigation')

    <link href="{{ asset('style.css') }}" rel="stylesheet">

    <div class="container mt-5">
        <h2 class="mb-4 text-center"><i class="bi bi-credit-card"></i> Оплата заказа</h2>

        @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if(!empty($pizzas))
            <div class="mb-5">
                <h4 class="text-center mb-4">Ваш заказ:</h4>
                <div class="d-flex justify-content-center flex-wrap gap-4">
                    @foreach($pizzas as $pizza)
                        <div class="text-center">
                            <img src="{{ asset('storage/' . $pizza['image_url']) }}" alt="{{ $pizza['name'] }}" class="rounded shadow" style="width: 100px; height: 100px; object-fit: cover;">
                            <p class="mt-2">{{ $pizza['name'] }}</p>
                            <p>Количество: {{ $pizza['quantity'] }}</p>
                            <p>Цена: {{ $pizza['price'] }} $</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="payment-wrapper p-4 rounded shadow">
            <p class="amount-label mb-3 text-center fs-5">
                💰 Сумма к оплате: <strong class="text-primary">{{ number_format($total, 2) }} $</strong>
            </p>

            <form id="payment-form" method="POST" action="{{ route('checkout.process') }}">
                @csrf
                <input type="hidden" name="amount" value="{{ $total }}">
                <input type="hidden" name="token" id="stripe-token">

                <div class="mb-3">
                    <label class="form-label">ФИО</label>
                    <input type="text" name="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Телефон</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Адрес доставки</label>
                    <textarea name="address" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label class="form-label">Комментарий к заказу</label>
                    <textarea name="note" class="form-control" rows="2"></textarea>
                </div>

                <div class="mb-4">
                    <label class="form-label">Способ оплаты</label>
                    <select name="payment_method" class="form-select" required>
                        <option value="card_online">Картой на сайте</option>
                        <option value="cash">Наличными курьеру</option>
                        <option value="courier_card">Картой курьеру</option>
                    </select>
                </div>

                <div id="card-element" class="stripe-input mb-3"></div>

                <button type="submit" class="btn-pay w-100">
                    💳 Оплатить
                </button>
            </form>
        </div>
    </div>
    @include('layouts.footer')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("{{ config('services.stripe.key') }}");
        const elements = stripe.elements();
        const card = elements.create('card', {
            style: {
                base: {
                    fontSize: '16px',
                    color: '#32325d',
                    fontFamily: 'Arial, sans-serif',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            }
        });
        card.mount('#card-element');

        const form = document.getElementById('payment-form');
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const method = document.querySelector('[name="payment_method"]').value;

            if (method === 'card_online') {
                const { token, error } = await stripe.createToken(card);
                if (error) {
                    alert(error.message);
                } else {
                    document.getElementById('stripe-token').value = token.id;
                    form.submit();
                }
            } else {
                form.submit();
            }
        });
    </script>

@endsection
