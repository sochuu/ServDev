<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;

class MainController extends Controller
{
    public function index()
    {
        $articles = $this->articles();

        return view('home', compact('articles'));
    }

    public function gallery(int $id)
    {
        $articles = $this->articles();
        abort_unless(isset($articles[$id]), 404);

        $article = $articles[$id];

        return view('gallery', compact('article'));
    }

    private function articles(): array
    {
        $path = public_path('articles.json');
        abort_unless(File::exists($path), 500, 'Файл articles.json не найден в public');

        return json_decode(File::get($path), true) ?? [];
    }
}
