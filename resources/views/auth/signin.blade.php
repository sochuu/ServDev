@extends('layouts.app')

@section('title', 'Регистрация')

@section('content')
    <h1>Регистрация</h1>
    <p>После сохранения пользователя откроется форма входа.</p>

    <form class="auth-form" method="POST" action="{{ route('signin.store') }}">
        @csrf

        <label>
            Имя
            <input type="text" name="name" value="{{ old('name') }}" required>
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
        </label>

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

        <button type="submit">Зарегистрироваться</button>
    </form>

    <p>Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a></p>
@endsection
