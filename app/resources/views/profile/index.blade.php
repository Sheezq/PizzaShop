<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Профиль пользователя</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('style.css') }}" rel="stylesheet">
</head>
<body>

@include('layouts.navigation')

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="profile-container text-center">
                <h1 class="display-5 fw-bold text-warning mb-4">Профиль пользователя</h1>

                <div class="mb-4">
                    @if ($user->avatar)
                        <img src="{{ asset('storage/' . $user->avatar) }}" alt="Аватар" class="avatar-img">
                    @else
                        <div class="default-avatar">
                            <span>👤</span>
                        </div>
                        <p class="text-muted mt-2">Аватар не установлен</p>
                    @endif
                </div>

                <div class="text-start px-4">
                    <p><span class="info-label">Имя:</span> {{ $user->name }}</p>
                    <p><span class="info-label">Email:</span> {{ $user->email }}</p>
                </div>

                <div class="mt-4">
                    <a href="{{ route('profile.edit') }}" class="btn btn-custom">Редактировать профиль</a>
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
