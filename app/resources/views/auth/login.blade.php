<x-guest-layout>

    <link href="{{ asset('style.css') }}" rel="stylesheet">

    <div class="login-wrapper">
        <div class="login-card">
            <h2 class="login-title">Вход в аккаунт</h2>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4 text-green-600 text-sm" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="form-group">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="error-msg" />
                </div>

                <!-- Password -->
                <div class="form-group">
                    <x-input-label for="password" :value="__('Пароль')" />
                    <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="error-msg" />
                </div>

                <!-- Remember Me -->
                <div class="form-check">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="form-checkbox" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Запомнить меня') }}</span>
                    </label>
                </div>

                <!-- Actions -->
                <div class="form-footer">
                    @if (Route::has('password.request'))
                        <a class="form-link" href="{{ route('password.request') }}">
                            Забыли пароль?
                        </a>
                    @endif

                    <x-primary-button class="btn-submit">
                        Войти
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>

</x-guest-layout>
