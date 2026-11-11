<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CommentPolicy
{
    public function create(User $user): Response
    {
        return ($user->isReader() || $user->isModerator())
            ? Response::allow()
            : Response::deny('Комментарии могут оставлять только авторизованные читатели и модераторы.');
    }

    public function update(User $user, Comment $comment): Response
    {
        return $user->isModerator()
            ? Response::allow()
            : Response::deny('Редактировать комментарии может только модератор.');
    }

    public function delete(User $user, Comment $comment): Response
    {
        return $user->isModerator()
            ? Response::allow()
            : Response::deny('Удалять комментарии может только модератор.');
    }
}
