<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
</head>
<body>

@include('layouts.navigation')

<div class="container mt-5">


    <section class="mb-5">
        <h2 class="section-title text-center mb-4">Контактная информация</h2>
        <p class="lead text-center">
            Мы всегда рады помочь! Свяжитесь с нами любым удобным способом.
        </p>

        <div class="row">
            <div class="col-md-6 mb-4">
                <h4>Наши адреса</h4>
                <ul class="list-unstyled">
                    <li><strong>Минск:</strong> ул. Романа 1</li>
                    <li><strong>Жодино:</strong> ул. Дмитрия 2</li>
                    <li><strong>Гродно:</strong> ул. Данилы 3</li>
                </ul>
            </div>

            <div class="col-md-6 mb-4" style="text-align: right;">
                <h4>Контактные данные</h4>
                <ul class="list-unstyled">
                    <li><strong>Телефон:</strong> +1111111111</li>
                    <li><strong>Электронная почта:</strong> <a href="mailto:info@pizzeria.ru">info@pizzeria.ru</a></li>
                    <li><strong>Часы работы:</strong> Пн-Пт: 10:00 - 22:00, Сб-Вс: 12:00 - 23:00</li>
                </ul>
            </div>
        </div>
    </section>


    <form action="{{ route('contact.submit') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Ваше имя</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Ваш email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="message" class="form-label">Ваше сообщение</label>
            <textarea class="form-control" id="message" name="message" rows="4" required></textarea>
        </div>
        <button type="submit" class="contact-btn btn btn-primary">Отправить сообщение</button>
    </form>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

</div>

@include('layouts.footer')


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
