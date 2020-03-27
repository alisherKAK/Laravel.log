@extends('layouts.app')

@section('content')

    @if (auth()->check())
        <div class="mb-3 btn-group btn-group-sm">

            @if (optional(auth()->user())->can('update', $post))
                <a class="btn btn-info" href="{{ route('posts.edit', $post) }}">Изменить</a>
            @endif

            @if (optional(auth()->user())->can('delete', $post))
                <a class="btn btn-danger delete-link" href="{{ route('posts.destroy', $post) }}"
                   data-target="delete-form">
                    Удалить
                    <form id="delete-form" action="{{ route('posts.destroy', $post) }}" method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                </a>
            @endif
        </div>
    @endif

    <div class="card card-body mb-3">
        <p class="text-muted">
            Автор: {{ $post->user->name }}
        </p>
        <h1>{{ $post->title }}</h1>
        <p class="lead">{{ $post->content }}</p>
    </div>

    @if (auth()->check())
        <form action="{{ route('comments.store') }}" method="POST" class="mb-3">
            @csrf
            <input type="hidden" name="post_id" value="{{ $post->id }}">
            <label for="content">Комментарий</label>
            @error('content')
            <div class="alert alert-danger mb-3">
                Ты должен написать комментарий. А не отправлять в пустую :(
            </div>
            @enderror
            <textarea name="content" id="content" class="form-control" placeholder="Ваш комментарий..."></textarea>
            <div>
                <button class="btn btn-secondary mt-2 btn-sm">Отправить</button>
            </div>
        </form>
    @endif

    @forelse($post->comments as $comment)
        <div class="card mb-3 @if($comment->user_id == optional(auth()->user())->id) border-primary @endif">
            <div class="card-body">
                {{ $comment->content }}
            </div>
            <small class="card-footer d-flex align-items-center">
                <span>{{$comment->user->name}}</span>
                <span class="ml-auto">{{ $comment->created_at }}</span>
                @if($comment->user_id == optional(auth()->user())->id)
                    <a href="{{ route('comments.destroy', $comment) }}"
                       class="comment-delete btn btn-outline-danger border-0 btn-sm ml-2"
                       data-target="comment-delete-{{$comment->id}}">
                        Удалить
                    </a>
                    <form id="comment-delete-{{$comment->id}}" action="{{ route('comments.destroy', $comment) }}"
                          method="POST">
                        @csrf @method('DELETE')
                    </form>
                @endif
            </small>
        </div>
    @empty
        <div class="alert alert-secondary">
            Пока нет комментариев. Будь первым!
        </div>
    @endforelse

    <script>
        let link = document.querySelector('.delete-link');
        let id = link.dataset.target;

        link.addEventListener('click', function (event) {
            event.preventDefault();
            let form = document.getElementById(id);
            form.submit();
        });

        let commentLinks = document.querySelectorAll('.comment-delete');
        for (let i = 0; i < commentLinks.length; i++) {
            let commentLink = commentLinks[i];
            let formId = commentLink.dataset.target;

            commentLink.addEventListener('click', function (event) {
                event.preventDefault();
                let form = document.getElementById(formId);
                form.submit();
            });
        }
    </script>

@endsection
