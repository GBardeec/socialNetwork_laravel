@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Редактирование книг</h1>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                        </ol>
                    </div>
                </div>
            </div>
        </div>


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{route('book.update',$book->id)}}" method="post">
                        @csrf
                        @method('PATCH')
                        <div class="w-25" >
                            Заголовок книги
                            <input type="text" class="form-control" name="title" placeholder="Текст"
                            value="{{$book->title}}">
                        @error('title')
                            <div class="text-danger">Это поле необходимо заполнить</div>
                        @enderror
                        </div>
                        <div class="w-25" >
                            Содержание книги
                            <input type="text" class="form-control" name="content" placeholder="Текст"
                                   value="{{$book->content}}">
                            @error('content')
                            <div class="text-danger">Это поле необходимо заполнить</div>
                            @enderror
                        </div>
                        <input type="submit" class="btn btn-secondary mt-3" value="Редактировать">
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
