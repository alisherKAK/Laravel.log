<?php
$update = isset($post);
?>

@extends('layouts.app')

@section('content')
    <h1>{{ $title }}</h1>
    <form action="{{ $update ? route('posts.update', $post) : route('posts.store') }}" method="POST" class="card card-body">
        @csrf
        @if ($update)
        @method('PUT')
        @endif
        <div class="form-group">
            <label for="title">Заголовок <span class="text-danger">*</span></label>
            <input type="text"
                   name="title"
                   id="title"
                   class="form-control @error('title') is-invalid @enderror"
                   placeholder="Введите заголовок..."
                   value="{{ old('title') ?? ($post->title ?? '') }}">
        @error('title')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>

        <div class="form-group">
            <label for="content">Пост <span class="text-danger">*</span></label>
            <textarea name="content"
                      id="content"
                      class="form-control @error('content') is-invalid @enderror"
                      placeholder="Расскажите что-нибудь интресное...">{{ old('content') ?? ($post->content ?? '') }}</textarea>
        @error('content')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
        </div>

        <div>
            <button class="btn btn-success">{{ $update ? 'Обновить' : 'Добавить' }}</button>
        </div>

    </form>

@endsection
