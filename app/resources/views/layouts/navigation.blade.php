<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<div class="navbar-decoration">
<nav class="navbar navbar-expand-lg custom-navbar">
    <div class="container d-flex justify-content-between align-items-center position-relative">

        {{-- Левая часть навигации --}}
        <ul class="navbar-nav flex-row">
            <li class="nav-item me-3">
                <a class="nav-link" href="{{ route('home') }}">Главная</a>
            </li>
            <li class="nav-item me-3">
                <a class="nav-link" href="{{ route('menu') }}">Меню</a>
            </li>
            <li class="nav-item me-3">
                <a class="nav-link" href="{{ route('info') }}">Информация</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('contacts') }}">Контакты</a>
            </li>
        </ul>

        {{-- Центр: логотип --}}
        <a href="{{ route('home') }}" class="position-absolute start-50 translate-middle-x">
            <img src="{{ asset('storage/images/logo.png') }}" alt="Logo" style="height: 40px;">
        </a>

        {{-- Правая часть: пользователь / вход / корзина --}}
        <div class="d-flex align-items-center">

            @if (Auth::check())
                <div class="dropdown user-menu me-3">
                    <a class="nav-link d-flex align-items-center text-white" href="#" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ Auth::user()->avatar
                            ? asset('storage/' . Auth::user()->avatar)
                            : 'https://t4.ftcdn.net/jpg/03/32/59/65/360_F_332596535_lAdLhf6KzbW6PWXBWeIFTovTii1drkbT.jpg' }}"
                             class="avatar-thumbnail">
                        <span class="user-name">{{ Auth::user()->name }}</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="{{ route('profile.index') }}">Профиль</a>
                        <a class="dropdown-item" href="{{ route('orders.history') }}">История заказов</a>
                        <a class="dropdown-item" href="{{ route('credits.index') }}">Кредиты</a>
                        <hr class="dropdown-divider">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item logout-btn">Выйти</button>
                        </form>
                    </div>
                </div>

                @if (Auth::user()->hasRole('admin'))
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-warning me-2">Админ-панель</a>
                @endif
            @else
                <a class="btn btn-primary me-2" href="{{ route('login') }}">Войти</a>
                <a class="btn btn-success me-2" href="{{ route('register') }}">Регистрация</a>
            @endif


            <a href="{{ route('cart.index') }}" class="btn btn-outline-light">
                <i class="bi bi-cart"></i>
                <span id="cart-count">{{ \App\Models\Cart::getTotalCount() }}</span>
            </a>
        </div>
    </div>
</nav>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdown = document.querySelector('.user-menu');
        const menu = dropdown.querySelector('.dropdown-menu');

        let isHovered = false;

        function showMenu() {
            menu.classList.add('show');
        }

        function hideMenu() {
            if (!isHovered) {
                menu.classList.remove('show');
            }
        }

        dropdown.addEventListener('mouseenter', () => {
            isHovered = true;
            showMenu();
        });

        dropdown.addEventListener('mouseleave', () => {
            isHovered = false;
            setTimeout(hideMenu, 200); // небольшая задержка — помогает при быстрой смене позиции
        });

        menu.addEventListener('mouseenter', () => {
            isHovered = true;
        });

        menu.addEventListener('mouseleave', () => {
            isHovered = false;
            setTimeout(hideMenu, 200);
        });
    });
</script>


