<nav class="navbar navbar-expand-lg navbar-dark custom-navbar">
    <div class="container d-flex justify-content-between align-items-center position-relative">

        <!-- Левая часть: меню -->
        <ul class="navbar-nav flex-row">
            <li class="nav-item me-3"><a class="nav-link" href="{{ route('home') }}">Главная</a></li>
            <li class="nav-item me-3"><a class="nav-link" href="{{ route('menu') }}">Меню</a></li>
            <li class="nav-item me-3"><a class="nav-link" href="{{ route('info') }}">Информация</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('contacts') }}">Контакты</a></li>
        </ul>

        <!-- Центр: логотип -->
        <a href="{{ route('home') }}" class="position-absolute start-50 translate-middle-x">
            <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" style="height: 40px;">
        </a>

        <!-- Правая часть: пользователь / кнопки / корзина -->
        <div class="d-flex align-items-center">
            @if (Auth::check())
                <div class="dropdown me-2">
                    <a class="nav-link dropdown-toggle d-flex align-items-center text-white" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ Auth::user()->avatar
                            ? asset('storage/' . Auth::user()->avatar)
                            : 'https://t4.ftcdn.net/jpg/03/32/59/65/360_F_332596535_lAdLhf6KzbW6PWXBWeIFTovTii1drkbT.jpg' }}"
                             class="rounded-circle" style="width: 30px; height: 30px; object-fit: cover; margin-right: 5px;">
                        <span>{{ Auth::user()->name }}</span>
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
                </div>

                @if(Auth::user()->hasRole('admin'))
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-warning me-2">Админ-панель</a>
                @endif
            @else
                <a class="btn btn-primary me-2" href="{{ route('login') }}">Войти</a>
                <a class="btn btn-success me-2" href="{{ route('register') }}">Регистрация</a>
            @endif

            <button id="theme-toggle" class="btn btn-outline-light me-2">🌙</button>

            <a href="{{ route('cart.index') }}" class="btn btn-outline-light">
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

    document.getElementById('theme-toggle').addEventListener('click', () => {
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
