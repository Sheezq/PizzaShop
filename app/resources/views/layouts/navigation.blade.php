<link href="{{ asset('style.css') }}" rel="stylesheet">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container d-flex align-items-center justify-content-between">
        <!-- Название -->
        <a class="navbar-brand" href="{{ route('home') }}">Пиццерия</a>

        <!-- Поисковая форма -->
        <form method="GET" action="{{ route('search') }}" class="search-form">
            <input
                type="text"
                name="query"
                class="search-input"
                placeholder="Поиск пиццы"
                value="{{ request('query') }}"
            >
            <button type="submit" class="search-btn">Поиск</button>
        </form>

        <!-- Кнопки пользователя -->
        <div class="navbar-nav d-flex align-items-center">
            @if (Auth::check())
                <!-- Профиль -->
                <a class="nav-link d-flex align-items-center" href="{{ route('profile.edit') }}">
                    <img src="{{ asset('storage/' . (Auth::user()->avatar ?? 'default-avatar.png')) }}" class="avatar-thumbnail" alt="Avatar" />
                    {{ Auth::user()->name }}
                </a>

                <!-- Кнопка для выхода -->
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn btn-danger">Выйти</button>
                </form>

                @if(Auth::user()->hasRole('admin'))
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-warning">Перейти в админ-панель</a>
                @endif
            @else
                <!-- Если пользователь не авторизован -->
                <a class="btn btn-primary" href="{{ route('login') }}">Войти</a>
                <a class="btn btn-success" href="{{ route('register') }}">Зарегистрироваться</a>
            @endif
        </div>
    </div>
</nav>
