@extends('layouts.app')

@section('content')

    <div class="d-flex align-items-center">
        <h1>Стена</h1>
    @if (auth()->check())
        <a href="{{ route('posts.create') }}" class="btn btn-success ml-auto">
            Создать пост
        </a>
    @endif
    </div>

@forelse($posts as $post)
    <a href="{{ route('posts.show', $post) }}" class="mb-3 card card-body d-flex flex-row align-items-center">
        <h4 class="mb-0">{{ $post->title }}</h4>
        <div class="text-muted ml-auto">
            Автор: {{ $post->user->name }}
        </div>
    </a>
@empty
    <div class="alert alert-secondary">
        Постов пока нет...
    </div>
@endforelse

@endsection
