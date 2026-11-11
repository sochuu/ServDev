<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index'])->name('home');
Route::get('/galery/{id}', [MainController::class, 'gallery'])->name('gallery');

Route::middleware('guest')->group(function () {
    Route::get('/signin', [AuthController::class, 'create'])->name('signin');
    Route::post('/signin', [AuthController::class, 'registration'])->name('signin.store');
    Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticate'])->name('login.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth:sanctum')
    ->name('logout');

Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{article}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{article}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{article}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    Route::post('/articles/{article}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
    Route::get('/comments/moderate', [CommentController::class, 'moderate'])->name('comments.moderate');
    Route::patch('/comments/{comment}/accept', [CommentController::class, 'accept'])->name('comments.accept');
    Route::delete('/comments/{comment}/reject', [CommentController::class, 'reject'])->name('comments.reject');
});

Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contacts', function () {
    $contacts = [
        ['label' => 'Адрес', 'value' => 'Москва, ул. Большая Семёновская, 38'],
        ['label' => 'Телефон', 'value' => '+7 (495) 223-05-23'],
        ['label' => 'Email', 'value' => 'info@mospolytech.ru'],
        ['label' => 'Режим работы', 'value' => 'Пн–Пт, 9:00–18:00'],
    ];

    return view('contacts', compact('contacts'));
})->name('contacts');
