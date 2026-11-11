@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <h1>Новости</h1>
    <p>Данные загружены из JSON через MainController::index.</p>

    <div class="news-grid">
        @foreach ($articles as $id => $article)
            <article class="news-card">
                <a href="{{ route('gallery', $id) }}">
                    <img src="{{ asset($article['preview_image']) }}" alt="{{ $article['name'] }}">
                </a>
                <div class="news-body">
                    <time>{{ $article['date'] }}</time>
                    <h2>{{ $article['name'] }}</h2>
                    <p>{{ $article['shortDesc'] ?? \Illuminate\Support\Str::limit($article['desc'], 120) }}</p>
                </div>
            </article>
        @endforeach
    </div>
@endsection
