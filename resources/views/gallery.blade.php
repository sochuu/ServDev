@extends('layouts.app')

@section('title', $article['name'])

@section('content')
    <p><a href="{{ route('home') }}">← к списку новостей</a></p>
    <h1>{{ $article['name'] }}</h1>
    <p>{{ $article['date'] }}</p>
    <img class="full-image" src="{{ asset($article['full_image']) }}" alt="{{ $article['name'] }}">
    <p>{{ $article['desc'] }}</p>
@endsection
