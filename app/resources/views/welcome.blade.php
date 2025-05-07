<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>О нашей Пиццерии</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
</head>

<body class="body_background">

@include('layouts.navigation')


<div class="container py-5">
    <section class="text-center mb-5">
        <h2 class="custom-title fw-bold display-5">О нашей пиццерии</h2>
        <p class="main_text lead mt-3">
            Добро пожаловать в нашу пиццерию! 🍕<br>
            Мы готовим пиццу с любовью, используя только свежие ингредиенты и традиционные итальянские рецепты.
            Наша цель — радовать каждого гостя вкусной едой и отличной атмосферой!
        </p>
    </section>

    <section class="text-center">
        <div class="custom-disc text-white py-4 rounded-top">
            <h2 class="fw-bold">Наши акции</h2>
        </div>

        <div class="row py-5 px-3 rounded-bottom shadow-sm">
            <div class="col-md-4 mb-4">
                <a href="{{ route('promo.twoforone') }}" class="card h-100 border-0 text-decoration-none text-dark">
                    <img src="https://sun9-73.userapi.com/impg/lUqxJriqP-MRmSDrCV-o2wRIwEyz_mV490LClw/zRLS8-Ru81w.jpg?size=1200x1200&quality=96&sign=260756b92c51a07aa04601518a9aca89&type=album" class="card-img-top rounded" alt="2 по цене 1">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">2 по цене 1</h5>
                        <p>Закажи одну пиццу и получи вторую бесплатно. Только по будням с 12:00 до 16:00.</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ route('promo.deliverydiscount') }}" class="card h-100 border-0 text-decoration-none">
                    <img src="https://sun9-18.userapi.com/impf/c852032/v852032748/1bfcba/qbdIASgKN5M.jpg?size=604x604&quality=96&sign=67ad0eaf1dbfe36de2c69ad58a97e82f&type=album" class="card-img-top rounded" alt="Скидка 20%">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">Скидка 20% на доставку</h5>
                        <p>Закажи доставку через сайт и получи скидку 20% на весь заказ!</p>
                    </div>
                </a>
            </div>
            <div class="col-md-4 mb-4">
                <a href="{{ route('promo.birthday') }}" class="card h-100 border-0 text-decoration-none">
                    <img src="https://pizzahot.me/wp-content/uploads/2021/04/dr.jpg" class="card-img-top rounded" alt="День рождения?">
                    <div class="card-body">
                        <h5 class="card-title fw-bold">День рождения?</h5>
                        <p>Именинникам — большая пицца в подарок при заказе от 1500 ₽!</p>
                    </div>
                </a>
            </div>
        </div>
    </section>
</div>
@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>


</body>


</html>

