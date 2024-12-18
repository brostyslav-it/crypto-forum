<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(): RedirectResponse
    {
        Comment::create([
            ...request()->validate([
                'content' => 'required|string|max:500',
                'post_id' => 'required|integer|exists:posts,id'
            ]),
            'user_id' => Auth::id()
        ]);

        return redirect()->back();
    }

    public function delete()
    {

    }
}
