

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Контакты</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

@include('layouts.navigation')

<div class="container mt-5">

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <section class="mb-5">
        <h2 class="section-title text-center mb-4">Контактная информация</h2>
        <p class="lead text-center">
            Мы всегда рады помочь! Свяжитесь с нами любым удобным способом.
        </p>

        <div class="row">
            <div class="col-md-6 mb-4">
                <h4>Наши адреса</h4>
                <ul class="list-unstyled">
                    <li><strong>Главный офис:</strong> ул. Пиццерийная, 1, Москва</li>
                    <li><strong>Филиал на Тверской:</strong> ул. Тверская, 5, Москва</li>
                    <li><strong>Филиал на Арбате:</strong> ул. Арбат, 3, Москва</li>
                </ul>
            </div>

            <div class="col-md-6 mb-4">
                <h4>Контактные данные</h4>
                <ul class="list-unstyled">
                    <li><strong>Телефон:</strong> +7 (123) 456-78-90</li>
                    <li><strong>Электронная почта:</strong> <a href="mailto:info@pizzeria.ru">info@pizzeria.ru</a></li>
                    <li><strong>Часы работы:</strong> Пн-Пт: 10:00 - 22:00, Сб-Вс: 12:00 - 23:00</li>
                </ul>
            </div>
        </div>
    </section>

    <section>
        <h2 class="section-title text-center mb-4">Обратная связь</h2>
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
            <button type="submit" class="btn btn-primary">Отправить сообщение</button>
        </form>
    </section>

</div>

@include('layouts.footer')

</body>
</html>
