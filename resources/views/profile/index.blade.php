@extends('layouts.main')

@section('content')
    <section>
        <div class="flex-container">
            <figure class="figure">
                <img src="{{asset('assets/img/user.png')}}" width="150px" height="150px" class="img-thumbnail"
                     alt="изображение пользователя">
            </figure>
            <ul class="list-group w-25">
                <li class="list-group-item">id пользователя: {{ $profile->user->id }}</li>
                <li class="list-group-item">Логин пользователя: {{ $profile->user->login }}</li>
            </ul>
        </div>
        <hr>
    </section>

    <section>
        <h5>
            Комментарии на стене пользователя
        </h5>

        <div id="new-comments-container">
            {{-- div для комментариев --}}
        </div>

        <div class="d-flex justify-content-center">
            <button id="load-more-comments" class="btn btn-secondary mb-3 " data-offset="{{ $profileCommentsCount }}">
                Загрузить еще комментарии
            </button>
        </div>

        @if(session('error'))
            <script>
                alert("{{ session('error') }}");
            </script>
        @endif

        @auth()
            <form action="{{ route('comment.add', $profile->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Заголовок комментария</label>
                    <input type="text" class="form-control" id="title" name="title">
                </div>
                @error('title')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="mb-3">
                    <label for="content" class="form-label">Текст комментария</label>
                    <textarea class="form-control" id="content" name="content" rows="3"></textarea>
                </div>
                @error('content')
                <div class="text-danger">{{ $message }}</div>
                @enderror
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">Отправить</button>
                </div>
            </form>
        @endauth
        @guest()
            <h3 class="text-center"> Чтобы оставить комментарий - авторизуйтесь </h3>
        @endguest
    </section>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

    $(document).on('click', '.btn-secondary[data-comment-id]', function () {
        let commentId = $(this).data('comment-id');
        let form = $(this).closest('form');
        let action = form.attr('action').replace('REPLACE_WITH_COMMENT_ID', commentId);
        form.attr('action', action);
    });

    $(document).ready(function () {
        let commentId;
        let offset = 0;
        const limit = 5;
        const profileId = {{ $profile->id }};

        function loadComments() {
            $.ajax({
                url: `/profile/${profileId}/load-more-comments`,
                type: 'GET',
                data: {
                    offset: offset,
                    limit: limit
                },
                success: function (response) {
                    console.log(response);

                    response.forEach(function (comment) {
                        let commentId = comment.id;
                        let commenterLogin = comment.users[0].login;
                        let parentCommentId = comment.parent_comment_id;
                        let parentContent = comment.parent_content;

                        let quoteText = '';
                        if (parentCommentId !== null) {
                            if (parentContent === null) {
                                quoteText = 'Цитата: комментарий удален';
                            } else {
                                quoteText = `Цитата: ${parentContent}`;
                            }
                        }

                        console.log(comment);

                        let commentHTML = `

                            ${quoteText ? `<div class="text-muted mt-5 border rounded p-3">${quoteText} </div>` : ''}
                        <div class="mb-5  border rounded p-3">
                            <div class="row">
                                <div class="col-1">
                                    <img src="/assets/img/user.png" width="60" height="60" class="rounded-circle">
                                </div>
                                <div class="col-9">
                                    <div class="d-flex justify-content-between">
                                        <div class="fw-bold">${commenterLogin}</div>
                                        <div class="col-2 d-flex flex-column align-items-end justify-content-start">
                                            @auth
                                            <form
                                                action="{{ route('comment.delete', ['profile' => $profile->id, 'comment' => 'REPLACE_WITH_COMMENT_ID']) }}"
                                                method="POST" class="mb-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-secondary"
                                                    data-comment-id="${comment.id}">
                                            Удалить
                                            </button>
                                            </form>
                                            <button type="button" class="btn  btn-secondary" data-bs-toggle="modal"
                                                    data-bs-target="#replyModal${comment.id}"
                                                    data-comment-id="${comment.id}">
                                                Ответить
                                            </button>
                                            @endauth
                                        </div>
                                    </div>
                                    <div>Заголовок: ${comment.title}</div>
                                    <div>Текст: ${comment.content}</div>
                                </div>
                            </div>
                        </div>


                        <div class="modal fade" id="replyModal${commentId}" tabindex="-1"
                             aria-labelledby="replyModalLabel${commentId}" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Ответ на комментарий
                                            пользователю: ${commenterLogin}</h5>

                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Закрыть"></button>
                                    </div>
                                    <form action="/profile/comment/reply/${comment.id}" method="POST">

                                        @csrf
                                        <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="reply_title" class="form-label">Заголовок ответа</label>
                                            <input type="text" class="form-control" id="reply_title" name="title">
                                        </div>
                                        @error('title')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        <div class="mb-3">
                                        <label for="reply_content" class="form-label">Текст ответа</label>
                                        <textarea class="form-control" id="reply_content" name="content"
                                                  rows="3"></textarea>
                                        </div>
                                        @error('content')
                                        <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-secondary mb-3">Отправить</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    `;
                    $('#new-comments-container').append(commentHTML);
                    });
                    },

        error: function (xhr, textStatus, errorThrown)
            {
                console.log(xhr.responseText);
                console.log(textStatus);
                console.log(errorThrown);
            }
            });
            }

       $('#load-more-comments').click(function ()
            {
                offset += limit;
                loadComments();
            }
       );

       loadComments();
    });
</script>
