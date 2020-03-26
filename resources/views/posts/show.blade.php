@extends('layouts.app')

@section('content')

    @if (auth()->check())
        <div class="mb-3 btn-group btn-group-sm">

        @if (auth()->user()->can('update', $post))
            <a class="btn btn-info" href="{{ route('posts.edit', $post) }}">Изменить</a>
        @endif

        @if (auth()->user()->can('delete', $post))
            <a class="btn btn-danger delete-link" href="{{ route('posts.destroy', $post) }}" data-target="delete-form">
                Удалить
                <form id="delete-form" action="{{ route('posts.destroy', $post) }}" method="POST" class="d-none">
                    @csrf
                    @method('DELETE')
                </form>
            </a>
        @endif
        </div>
    @endif

    <p class="text-muted">
        Автор: {{ $post->user->name }}
    </p>
    <h1>{{ $post->title }}</h1>
    <p class="lead">{{ $post->content }}</p>

@if (auth()->user()->can('delete', $post))
    <script>
        let link = document.querySelector('.delete-link');
        let id = link.dataset.target;

        console.log(id);

        link.addEventListener('click', function (event) {
            event.preventDefault();
            let form = document.getElementById(id);
            form.submit();
        });
    </script>
@endif

@endsection
