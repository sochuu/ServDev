<?php

namespace App\Providers;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use App\Policies\ArticlePolicy;
use App\Policies\CommentPolicy;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Gate::policy(Article::class, ArticlePolicy::class);
        Gate::policy(Comment::class, CommentPolicy::class);

        Gate::before(function (?User $user, string $ability) {
            if ($user?->isModerator()) {
                return true;
            }

            return null;
        });

        Gate::define('moderate', function (User $user) {
            return $user->isModerator()
                ? Response::allow()
                : Response::deny('Действие доступно только модератору.');
        });
    }
}
