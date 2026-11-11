<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class ArticlePolicy
{
    public function viewAny(?User $user): Response
    {
        return Response::allow();
    }

    public function view(?User $user, Article $article): Response
    {
        return Response::allow();
    }

    public function create(User $user): Response
    {
        return $user->isModerator()
            ? Response::allow()
            : Response::deny('Создавать статьи может только модератор.');
    }

    public function update(User $user, Article $article): Response
    {
        return $user->isModerator()
            ? Response::allow()
            : Response::deny('Редактировать статьи может только модератор.');
    }

    public function delete(User $user, Article $article): Response
    {
        return $user->isModerator()
            ? Response::allow()
            : Response::deny('Удалять статьи может только модератор.');
    }
}
