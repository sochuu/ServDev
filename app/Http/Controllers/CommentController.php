<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Article $article)
    {
        $this->authorize('create', Comment::class);

        $data = $request->validate([
            'body' => ['required', 'string', 'min:3', 'max:1000'],
        ]);

        $article->comments()->create([
            'user_id' => $request->user()->id,
            'body' => $data['body'],
            'approved' => false,
        ]);

        return back()->with('success', 'Комментарий отправлен и ожидает модерации');
    }

    public function moderate()
    {
        $this->authorize('moderate', Comment::class);

        $comments = Comment::query()
            ->with(['user', 'article'])
            ->where('approved', false)
            ->latest()
            ->get();

        return view('comments.moderate', compact('comments'));
    }

    public function accept(Comment $comment)
    {
        $this->authorize('moderate', Comment::class);

        $comment->update(['approved' => true]);

        return back()->with('success', 'Комментарий принят');
    }

    public function reject(Comment $comment)
    {
        $this->authorize('moderate', Comment::class);

        $comment->delete();

        return back()->with('success', 'Комментарий отклонён');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back()->with('success', 'Комментарий удалён');
    }
}
