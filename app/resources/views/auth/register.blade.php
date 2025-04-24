<x-guest-layout>


    <link href="{{ asset('style.css') }}" rel="stylesheet">

    <div class="register-wrapper">
        <div class="register-card">
            <h2 class="register-title">Регистрация</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="form-group">
                    <x-input-label for="name" :value="__('Имя')" />
                    <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="error-msg" />
                </div>

                <!-- Email -->
                <div class="form-group">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="error-msg" />
                </div>

                <!-- Password -->
                <div class="form-group">
                    <x-input-label for="password" :value="__('Пароль')" />
                    <x-text-input id="password" class="form-control" type="password" name="password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="error-msg" />
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <x-input-label for="password_confirmation" :value="__('Подтвердите пароль')" />
                    <x-text-input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="error-msg" />
                </div>

                <div class="form-footer">
                    <a class="form-link" href="{{ route('login') }}">
                        Уже зарегистрированы?
                    </a>

                    <x-primary-button class="btn-submit">
                        Зарегистрироваться
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
