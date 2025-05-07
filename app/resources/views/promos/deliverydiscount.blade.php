<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Скидка 20% на доставку</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
</head>

<body class="body_background">

@include('layouts.navigation')

<div class="container py-5">
    <section class="text-center mb-5">
        <h2 class="custom-title fw-bold display-5">Акция: Скидка 20% на доставку</h2>
        <p class="main_text lead mt-3">
            Закажи доставку через наш сайт и получи скидку 20% на весь заказ! 🚚<br>
            Наслаждайся вкусной пиццей с комфортом и выгодой.
        </p>
        <img src="https://sun9-18.userapi.com/impf/c852032/v852032748/1bfcba/qbdIASgKN5M.jpg?size=604x604&quality=96&sign=67ad0eaf1dbfe36de2c69ad58a97e82f&type=album" class="img-fluid rounded my-4" alt="Скидка 20%">
    </section>
    <section>
        <h4 class="fw-bold">Условия акции</h4>
        <ul class="list-unstyled mt-3">
            <li>Акция действует только при заказе через наш сайт.</li>
            <li>Скидка 20% предоставляется на все товары в заказе.</li>
            <li>Скидка не распространяется на напитки и соусы.</li>
        </ul>
    </section>
</div>

@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
