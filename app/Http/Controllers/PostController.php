<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function show(Post $post): View
    {
        return view('show-post', ['post' => $post]);
    }

    public function store(Request $request): RedirectResponse
    {
        Post::create([
            ...$request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string|max:5000',
                'category_id' => 'required|exists:categories,id',
                'image' => 'nullable|image|max:2048',
            ]),
            'user_id' => Auth::id(),
            'image' => $request->hasFile('image') ? $request->file('image')->store('posts', 'public_uploads') : null
        ]);

        return to_route('posts.view');
    }
}
