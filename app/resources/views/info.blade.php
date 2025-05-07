<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Информация о пиццерии</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
</head>
<body>

@include('layouts.navigation')

<main class="custom-info container mt-5 mb-5">

    <section class="custom-info mb-5">
        <h2 class="text-center mb-4">О нас</h2>
        <p class="lead text-center">
            Наша пиццерия — это место, где каждый найдет пиццу по своему вкусу! 🍕
            Мы тщательно отбираем ингредиенты, следим за качеством и создаем уютную атмосферу для каждого гостя.
        </p>
    </section>

    <section class="mb-5">
        <h2 class="text-center mb-4">Почему выбирают нас?</h2>
        <div class="row text-center">
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Свежие ингредиенты</h5>
                        <p class="card-text">Мы используем только натуральные продукты от проверенных поставщиков.</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Быстрая доставка</h5>
                        <p class="card-text">Доставляем горячую пиццу за считанные минуты, сохраняя её вкус и аромат!</p>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">Доступные цены</h5>
                        <p class="card-text">У нас всегда отличные акции и бонусы для постоянных клиентов.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>
@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>


</html>
