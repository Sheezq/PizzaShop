<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Условия использования</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
</head>
<body>

@include('layouts.navigation')

<div class="container mt-5">
    <section class="mb-5">
        <h2 class="section-title text-center mb-4">Условия использования</h2>
        <p class="lead text-center">
            Пожалуйста, внимательно прочтите эти условия перед использованием нашего сайта и сервиса.
        </p>

        <div class="mt-4">
            <h4>1. Общие положения</h4>
            <p>Используя сайт, вы соглашаетесь с настоящими условиями. Если вы не согласны — не используйте наш сервис.</p>

            <h4>2. Услуги</h4>
            <p>Мы предоставляем сервис онлайн-заказа еды. Мы можем изменять или прекращать услуги в любое время.</p>

            <h4>3. Ответственность</h4>
            <p>Мы не несем ответственности за задержки или ошибки, вызванные третьими сторонами (например, службой доставки).</p>

            <h4>4. Пользовательские данные</h4>
            <p>Вы обязуетесь предоставлять только достоверную информацию. Мы не несем ответственности за ущерб, вызванный ложными данными.</p>

            <h4>5. Изменения условий</h4>
            <p>Мы оставляем за собой право изменять эти условия в любое время. Актуальная версия всегда доступна на сайте.</p>

            <h4>6. Контакты</h4>
            <p>По всем вопросам обращайтесь: <a href="mailto:legal@bropizza.com">legal@bropizza.com</a></p>
        </div>
    </section>
</div>

@include('layouts.footer')

</body>
</html>
