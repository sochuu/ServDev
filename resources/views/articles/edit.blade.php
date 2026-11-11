@extends('layouts.app')

@section('title', 'Редактирование')

@section('content')
    <h1>Редактировать статью</h1>
    <p><a href="{{ route('articles.show', $article) }}">← к статье</a></p>

    <form class="auth-form article-form" method="POST" action="{{ route('articles.update', $article) }}">
        @method('PUT')
        @include('articles._form')
        <button type="submit">Обновить</button>
    </form>
@endsection
