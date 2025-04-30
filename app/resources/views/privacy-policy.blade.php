<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Политика конфиденциальности</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
</head>
<body>

@include('layouts.navigation')

<div class="container mt-5">
    <section class="mb-5">
        <h2 class="section-title text-center mb-4">Политика конфиденциальности</h2>
        <p class="lead text-center">
            Мы уважаем вашу конфиденциальность и обязуемся защищать ваши персональные данные.
        </p>

        <div class="mt-4">
            <h4>1. Сбор информации</h4>
            <p>Мы собираем только ту информацию, которая необходима для оказания услуг: имя, email, адрес доставки и контактный номер.</p>

            <h4>2. Использование данных</h4>
            <p>Собранные данные используются исключительно для обработки заказов, поддержки клиентов и улучшения качества сервиса.</p>

            <h4>3. Хранение данных</h4>
            <p>Мы храним ваши данные на защищённых серверах и применяем меры безопасности для предотвращения несанкционированного доступа.</p>

            <h4>4. Передача третьим лицам</h4>
            <p>Мы не передаём ваши персональные данные третьим лицам, за исключением случаев, предусмотренных законом или необходимостью доставки.</p>

            <h4>5. Cookies</h4>
            <p>Мы используем файлы cookies для улучшения пользовательского опыта. Вы можете отключить cookies в настройках браузера.</p>

            <h4>6. Изменения политики</h4>
            <p>Мы можем обновлять эту политику в любое время. Пожалуйста, проверяйте её периодически на предмет изменений.</p>

            <h4>7. Контакты</h4>
            <p>По вопросам конфиденциальности обращайтесь: <a href="mailto:privacy@bropizza.com">privacy@bropizza.com</a></p>
        </div>
    </section>
</div>

@include('layouts.footer')

</body>
</html>
