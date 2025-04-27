@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm rounded-4">
                    <div class="card-body text-center p-5">
                        <h1 class="card-title mb-4" style="font-weight: bold;">Ваши кредиты</h1>

                        <div class="mb-4">
                            <img src="https://cdn-icons-png.flaticon.com/512/190/190411.png" alt="Credits" width="100">
                        </div>

                        <p class="card-text fs-5 text-muted">
                            У вас пока нет доступных кредитов.<br>
                            Делайте заказы и получайте бонусы! 🎉
                        </p>

                        <a href="{{ route('home') }}" class="btn btn-primary mt-4">
                            Вернуться на главную
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
