@extends('layouts.main')

@section('content')
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Добавление книг</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <form action="{{route('book.store')}}" method="POST">
                        @csrf
                        <div class="w-25 mt-3" >
                            <label for="title" class="form-label">Заголовок</label>
                            <input type="text" class="form-control" name="title" placeholder="Текст">
                        @error('title')
                            <div class="text-danger">Это поле необходимо заполнить</div>
                        @enderror
                        </div>
                        <div class="w-25 mt-3" >
                            <div class="mb-3">
                                <label for="content" class="form-label">Текст книги</label>
                                <textarea class="form-control" id="content" name="content" rows="3" placeholder="Текст"></textarea>
                            </div>
                            @error('content')
                            <div class="text-danger">Это поле необходимо заполнить</div>
                            @enderror
                        </div>
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="submit" class="btn btn-secondary mt-3" value="Добавить">
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
