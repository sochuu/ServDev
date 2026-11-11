<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Mail\NewArticleMail;
use App\Models\Article;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class ArticleController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', Article::class);

        $articles = Article::query()->orderByDesc('date')->paginate(6);

        return view('articles.index', compact('articles'));
    }

    public function create()
    {
        $this->authorize('create', Article::class);

        return view('articles.create');
    }

    public function store(ArticleRequest $request)
    {
        $this->authorize('create', Article::class);

        $article = Article::create($request->validated());

        $emails = User::query()
            ->whereHas('role', fn ($query) => $query->where('slug', Role::MODERATOR))
            ->pluck('email');

        if ($notify = env('MAIL_MODERATOR_ADDRESS')) {
            $emails->push($notify);
        }

        foreach ($emails->unique()->filter() as $email) {
            Mail::to($email)->send(new NewArticleMail($article));
        }

        return redirect()
            ->route('articles.show', $article)
            ->with('success', 'Статья создана, уведомление отправлено модератору');
    }

    public function show(Article $article)
    {
        $this->authorize('view', $article);

        $article->load(['approvedComments.user']);

        return view('articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $this->authorize('update', $article);

        return view('articles.edit', compact('article'));
    }

    public function update(ArticleRequest $request, Article $article)
    {
        $this->authorize('update', $article);

        $article->update($request->validated());

        return redirect()
            ->route('articles.show', $article)
            ->with('success', 'Статья обновлена');
    }

    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);

        $article->delete();

        return redirect()
            ->route('articles.index')
            ->with('success', 'Статья удалена');
    }
}
