<!-- Навигационная панель -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <!-- Название -->
        <a class="navbar-brand" href="{{ route('home') }}">🍕BROLIU PICA</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Главная</a></li>
                <a class="nav-link" href="{{ route('menu') }}">Меню</a>
                <li class="nav-item"><a class="nav-link" href="{{ route('info') }}">Информация</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('contacts') }}">Контакты</a></li>
            </ul>

            <ul class="navbar-nav ms-auto">
                @if (Auth::check())
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('storage/' . (Auth::user()->avatar ?? 'default-avatar.png')) }}" class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover; margin-right: 5px;">
                            {{ Auth::user()->name }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Профиль</a></li>
                            <li><a class="dropdown-item" href="{{ route('orders.history') }}">История заказов</a></li>
                            <li><a class="dropdown-item" href="{{ route('credits.index') }}">Кредиты</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Выйти</button>
                                </form>
                            </li>
                        </ul>
                    </li>

                    @if(Auth::user()->hasRole('admin'))
                        <li class="nav-item ms-2">
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-warning">Админ-панель</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="btn btn-primary" href="{{ route('login') }}">Войти</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-success" href="{{ route('register') }}">Регистрация</a>
                    </li>
                @endif
            </ul>

            <button id="theme-toggle" class="btn btn-outline-light ms-3">🌙</button>


            <a href="{{ route('cart.index') }}" class="btn btn-outline-light ms-3">
                <i class="bi bi-cart"></i>
                <span id="cart-count">{{ \App\Models\Cart::getTotalCount() }}</span>
            </a>
        </div>
    </div>
</nav>

<script>
    const currentTheme = localStorage.getItem('theme');
    if (currentTheme === 'dark') {
        document.body.classList.add('dark-mode');
        document.getElementById('theme-toggle').innerHTML = '🌞';
    } else {
        document.body.classList.add('light-mode');
        document.getElementById('theme-toggle').innerHTML = '🌙';
    }


    const themeToggleButton = document.getElementById('theme-toggle');

    themeToggleButton.addEventListener('click', () => {
        document.body.classList.toggle('dark-mode');
        document.body.classList.toggle('light-mode');


        if (document.body.classList.contains('dark-mode')) {
            localStorage.setItem('theme', 'dark');
            themeToggleButton.innerHTML = '🌞';
        } else {
            localStorage.setItem('theme', 'light');
            themeToggleButton.innerHTML = '🌙';
        }
    });
</script>
