@extends('layouts.main')

@section('content')

    <h3 class="mb-4 mt-4">
        Комментарии пользователя:
    </h3>

    @if ($comments->isEmpty())
        <h5>У вас пока нет комментариев.</h5>
    @else
        <div class="">
            <table class="table w-50">
                <thead>
                <tr>
                    <th scope="col">Заголовок</th>
                    <th scope="col">Текст</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach ($comments as $comment)
                    <tr>
                        <th scope="row">{{ $comment->title }}</th>
                        <td>{{ $comment->content }}</td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
        </div>
@endsection
