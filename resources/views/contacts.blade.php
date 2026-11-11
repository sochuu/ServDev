@extends('layouts.app')

@section('title', 'Контакты')

@section('content')
    <h1>Контакты</h1>
    <p>Данные переданы в шаблон массивом через <code>view()</code> и выводятся динамически.</p>

    <ul class="contacts">
        @foreach ($contacts as $item)
            <li>
                <strong>{{ $item['label'] }}</strong>
                <span>{{ $item['value'] }}</span>
            </li>
        @endforeach
    </ul>
@endsection
