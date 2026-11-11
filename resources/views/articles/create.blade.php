@extends('layouts.app')

@section('title', 'Новая статья')

@section('content')
    <h1>Создать статью</h1>
    <p><a href="{{ route('articles.index') }}">← к списку</a></p>

    <form class="auth-form article-form" method="POST" action="{{ route('articles.store') }}">
        @include('articles._form')
        <button type="submit">Сохранить</button>
    </form>
@endsection
