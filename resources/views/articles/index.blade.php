@extends('layouts.app')

@section('title', 'Новости из БД')

@section('content')
    <h1>Новости</h1>
    <p>CRUD + пагинация. Данные из таблицы articles.</p>
    @can('create', App\Models\Article::class)
        <p><a class="btn" href="{{ route('articles.create') }}">Добавить статью</a></p>
    @endcan

    @if ($articles->isEmpty())
        <p>Пока нет записей. Выполните: <code>php artisan migrate --seed</code></p>
    @else
        <div class="news-grid">
            @foreach ($articles as $article)
                <article class="news-card">
                    <a href="{{ route('articles.show', $article) }}">
                        <img src="{{ asset($article->preview_image) }}" alt="{{ $article->name }}">
                    </a>
                    <div class="news-body">
                        <time>{{ $article->date->format('d.m.Y') }}</time>
                        <h2><a href="{{ route('articles.show', $article) }}">{{ $article->name }}</a></h2>
                        <p>{{ $article->short_desc }}</p>
                        @can('update', $article)
                            <p class="crud-actions">
                                <a href="{{ route('articles.edit', $article) }}">Изменить</a>
                                <form method="POST" action="{{ route('articles.destroy', $article) }}" onsubmit="return confirm('Удалить статью?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="linkish">Удалить</button>
                                </form>
                            </p>
                        @endcan
                    </div>
                </article>
            @endforeach
        </div>

        <div class="pagination-wrap">
            {{ $articles->links() }}
        </div>
    @endif
@endsection
