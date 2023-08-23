@extends('layouts.main')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Список книг</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2 mb-3">
                        <a href="{{route('book.create')}}" class="btn btn-block btn-secondary">Добавить книгу</a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Название</th>
                                        <th>Действие</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($books as $book)
                                        <tr>
                                            <td>{{$book -> id}}</td>
                                            <td>{{$book -> title}}</td>
                                            <td>
                                                <a class="btn btn-secondary" href="{{route('book.show', $book->id)}}">
                                                    подробнее
                                                </a>
                                            </td>
                                            <td>
                                                <a href="{{route('book.edit', $book->id)}}" class="btn btn-secondary">
                                                    редактировать
                                                </a>
                                            </td>
                                            <td>
                                                <form action="{{route('book.delete', $book->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-secondary" type="submit">
                                                        <i>удалить</i>
                                                    </button>
                                                </form>
                                            </td>
                                            <td>
                                                @if (!$book->link_accessible)
                                                    <form action="{{ route('library.make-public', ['profileId' => $user->id, 'bookId' => $book->id]) }}" method="POST">
                                                        @csrf
                                                        <button type="submit" class="btn btn-secondary">Книга по ссылке доступна для всех</button>
                                                    </form>
                                                @else
                                                    Книга доступна по ссылке для всех
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
