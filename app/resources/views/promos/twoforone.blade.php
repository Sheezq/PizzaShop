<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>2 по цене 1</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
</head>

<body class="body_background">

@include('layouts.navigation')

<div class="container py-5">
    <section class="text-center mb-5">
        <h2 class="custom-title fw-bold display-5">Акция: 2 по цене 1</h2>
        <p class="main_text lead mt-3">
            Закажи одну пиццу и получи вторую бесплатно! 🍕<br>
            Эта акция действует только по будням с 12:00 до 16:00. Успей воспользоваться!
        </p>
        <img src="https://sun9-73.userapi.com/impg/lUqxJriqP-MRmSDrCV-o2wRIwEyz_mV490LClw/zRLS8-Ru81w.jpg?size=1200x1200&quality=96&sign=260756b92c51a07aa04601518a9aca89&type=album" class="img-fluid rounded my-4" alt="2 по цене 1" style="max-width: 50%; height: auto;">
    </section>
    <section>
        <h4 class="fw-bold">Условия акции</h4>
        <ul class="list-unstyled mt-3">
            <li>Акция действует только в будние дни.</li>
            <li>Время действия: с 12:00 до 16:00.</li>
            <li>Предложение действительно при заказе через сайт.</li>
            <li>Обе пиццы должны быть одинакового размера.</li>
        </ul>
    </section>
</div>

@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
