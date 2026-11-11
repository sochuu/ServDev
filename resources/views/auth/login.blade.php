@extends('layouts.app')

@section('title', 'Вход')

@section('content')
    <h1>Авторизация</h1>
    <p>После входа выдаётся токен Sanctum, дальше можно работать с защищёнными страницами.</p>

    <form class="auth-form" method="POST" action="{{ route('login.store') }}">
        @csrf

        <label>
            Email
            <input type="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror
        </label>

        <label>
            Пароль
            <input type="password" name="password" required>
            @error('password')
                <span class="error">{{ $message }}</span>
            @enderror
        </label>

        <button type="submit">Войти</button>
    </form>

    <p>Нет аккаунта? <a href="{{ route('signin') }}">Регистрация</a></p>
@endsection
