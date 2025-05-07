<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>День Рождения?</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
</head>

<body class="body_background">

@include('layouts.navigation')

<div class="container py-5">
    <section class="text-center mb-5">
        <h2 class="custom-title fw-bold display-5">День рождения? Получи пиццу в подарок!</h2>
        <p class="main_text lead mt-3">
            Поздравляем с Днем Рождения! 🎉 При заказе от 15 $ — большая пицца в подарок!<br>
            Отпразднуй с нами в кругу друзей и получи отличный бонус!
        </p>
        <img src="https://pizzahot.me/wp-content/uploads/2021/04/dr.jpg" class="img-fluid rounded my-4" alt="День рождения">
    </section>
    <section>
        <h4 class="fw-bold">Условия акции</h4>
        <ul class="list-unstyled mt-3">
            <li>Акция действует только на заказы от 15 $.</li>
            <li>Подарочная пицца — большая на выбор из стандартного меню.</li>
            <li>Необходимо предъявить документ, подтверждающий день рождения.</li>
        </ul>
    </section>
</div>

@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
