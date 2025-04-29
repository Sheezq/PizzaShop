<h2>Спасибо за ваш заказ!</h2>

<p>Здравствуйте, {{ $order->name }}!</p>

<p>Ваш заказ успешно оформлен. Детали:</p>

<ul>
    <li><strong>Сумма:</strong> {{ number_format($order->total_price, 2) }} ₽</li>
    <li><strong>Оплата:</strong> {{ $order->payment_method }}</li>
    <li><strong>Адрес доставки:</strong> {{ $order->address }}</li>
</ul>

<p>Мы скоро свяжемся с вами по телефону: {{ $order->phone }}</p>

<p>Спасибо, что выбрали нас!</p>
