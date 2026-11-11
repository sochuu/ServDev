@extends('layouts.app')

@section('title', $article->name)

@section('content')
    <p><a href="{{ route('articles.index') }}">← к списку новостей</a></p>
    <h1>{{ $article->name }}</h1>
    <p>{{ $article->date->format('d.m.Y') }}</p>

    @can('update', $article)
        <p class="crud-actions">
            <a class="btn" href="{{ route('articles.edit', $article) }}">Редактировать</a>
            <form method="POST" action="{{ route('articles.destroy', $article) }}" onsubmit="return confirm('Удалить статью?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Удалить</button>
            </form>
        </p>
    @endcan

    <img class="full-image" src="{{ asset($article->full_image) }}" alt="{{ $article->name }}">
    <p>{{ $article->desc }}</p>

    <h2>Комментарии</h2>
    @forelse ($article->comments as $comment)
        <div class="comment">
            <strong>{{ $comment->user?->name ?? 'Гость' }}</strong>
            <time>{{ $comment->created_at->format('d.m.Y H:i') }}</time>
            <p>{{ $comment->body }}</p>
            @can('delete', $comment)
                <form method="POST" action="{{ route('comments.destroy', $comment) }}" onsubmit="return confirm('Удалить комментарий?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="linkish">Удалить</button>
                </form>
            @endcan
        </div>
    @empty
        <p>Пока нет комментариев.</p>
    @endforelse

    @auth
        @can('create', App\Models\Comment::class)
            <form method="POST" action="{{ route('comments.store', $article) }}">
                @csrf
                <p>
                    <label for="body">Добавить комментарий</label>
                    <textarea id="body" name="body" rows="3" required>{{ old('body') }}</textarea>
                </p>
                @error('body')
                    <p class="error">{{ $message }}</p>
                @enderror
                <button class="btn" type="submit">Отправить</button>
            </form>
        @endcan
    @else
        <p><a href="{{ route('login') }}">Войдите</a>, чтобы оставить комментарий.</p>
    @endauth
@endsection
