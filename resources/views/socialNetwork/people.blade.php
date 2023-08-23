@extends('layouts.main')

@section('content')

    <h3 class="mb-4 mt-4">
        Список пользователей:
    </h3>

    <div class="">
        <table class="table w-25">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Login</th>
                <th scope="col">Действие</th>
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->login }}</td>
                        <td>
                            <a class="btn btn-secondary" href="{{ route('profile.show', $user->profile->id) }}">
                                Посмотреть профиль
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
