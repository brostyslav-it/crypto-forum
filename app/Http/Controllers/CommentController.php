<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class CommentController extends Controller
{
    public function store(): RedirectResponse
    {
        if (!Auth::check()) {
            abort(403);
        }
        Comment::create([
            ...request()->validate([
                'content' => 'required|string|max:500',
                'post_id' => 'required|integer|exists:posts,id'
            ]),
            'user_id' => Auth::id()
        ]);

        return redirect()->back();
    }

    public function destroy(Comment $comment): RedirectResponse
    {
        Gate::authorize('delete-comment', $comment);
        $comment->delete();
        return redirect()->back();
    }
}
