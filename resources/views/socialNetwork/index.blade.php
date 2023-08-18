@extends('layouts.main')

@section('content')

    @auth
        <h5>
            Авторизация произошла успешно. Добро пожаловать, {{ auth()->user()->login }}!
        </h5>
    @endauth

    @guest()
        Пользователь не авторизован
    @endguest

@endsection
