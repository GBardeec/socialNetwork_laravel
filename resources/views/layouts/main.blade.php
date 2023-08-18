<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To do list</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="{{asset('assets/style/style.css')}}" rel="stylesheet">
</head>
<body>
<nav>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light mb-3">
            <div class="container-fluid">
                <i class="navbar-brand fs-4 mr-3">Social network</i>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Переключатель навигации">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ">
                        <li class="nav-item ">
                            <a class="nav-link active " aria-current="page" href="{{route('main.index')}}">Главная</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('profile.index')}}">Список пользователей</a>
                        </li>
                        @auth()
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('profile.show', auth()->user()->profile->id) }}">Личный кабинет</a>
                            </li>
                        @endauth
                        @auth()
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{ route('comments.show') }}">Комментарии пользователя</a>
                            </li>
                        @endauth
                    </ul>
                    <div class="d-flex">
                        @auth()
                            <a type="button" class="btn btn-secondary" href="{{route('auth.logout')}}" >
                                Выйти
                            </a>
                        @endauth
                        @guest()
                            <a type="button" class="btn btn-secondary" href="{{route('auth.login')}}" >
                                Авторизация
                            </a>
                        @endguest
                    </div>
                </div>
            </div>
        </nav>
    </div>
</nav>


<main>
    <div class="container">
        @yield('content')
    </div>
</main>

<footer class="mt-3">
    <div class="container">
        <p class="fw-light">Социальная сеть.</p>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>
</html>

