@extends('layouts.app')

@section('title', 'Модерация комментариев')

@section('content')
    <h1>Комментарии на модерации</h1>
    <p>Показаны только непроверенные комментарии. Принять — опубликовать, отклонить — удалить.</p>

    @forelse ($comments as $comment)
        <article class="comment">
            <p><strong>{{ $comment->user?->name ?? 'Гость' }}</strong> к статье
                <a href="{{ route('articles.show', $comment->article) }}">{{ $comment->article?->name }}</a>
            </p>
            <time>{{ $comment->created_at->format('d.m.Y H:i') }}</time>
            <p>{{ $comment->body }}</p>
            <p class="crud-actions">
                <form method="POST" action="{{ route('comments.accept', $comment) }}">
                    @csrf
                    @method('PATCH')
                    <button type="submit" class="btn">Принять</button>
                </form>
                <form method="POST" action="{{ route('comments.reject', $comment) }}" onsubmit="return confirm('Отклонить комментарий?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Отклонить</button>
                </form>
            </p>
        </article>
    @empty
        <p>Нет комментариев, ожидающих модерации.</p>
    @endforelse
@endsection