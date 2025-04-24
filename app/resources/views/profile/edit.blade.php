<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль пользователя</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<!-- Навигационная панель -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('profile.edit') }}">Профиль</a>
        <a class="btn btn-outline-light" href="{{ route('home') }}">На сайт</a>
    </div>
</nav>

<div class="container mt-4">
    <h1 class="text-center">Редактирование профиля</h1>

    <!-- Статус успешного обновления -->
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <!-- Форма редактирования профиля -->
    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <!-- Поле для имени -->
        <div class="mb-3">
            <label for="name" class="form-label">Имя</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Поле для email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Поле для нового пароля -->
        <div class="mb-3">
            <label for="password" class="form-label">Новый пароль</label>
            <input type="password" class="form-control" id="password" name="password">
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Подтверждение пароля -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Подтвердите пароль</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
        </div>

        <!-- Поле для аватара -->
        <div class="mb-3">
            <label for="avatar" class="form-label">Аватар</label>
            <input type="file" class="form-control" id="avatar" name="avatar">
            @error('avatar')
            <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Кнопка для обновления данных -->
        <button type="submit" class="btn btn-primary">Обновить</button>
    </form>

    <!-- Кнопка для возврата на главную -->
    <div class="mt-3">
        <a href="{{ route('home') }}" class="btn btn-secondary">Вернуться на главную</a>
    </div>
</div>

<!-- Подключение скриптов для Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
