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
                    <div class="col-6">
                        <div class="card">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Название</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($books as $book)
                                            <tr>
                                                <td>{{ $book->id }}</td>
                                                <td>{{ $book->title }}</td>
                                                <td><a href="{{ route('library.show', ['profileId' => $user->id, 'book' => $book->id]) }}" class="btn btn-secondary">
                                                        подробнее
                                                    </a>
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
