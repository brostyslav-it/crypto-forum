<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function show(Post $post): View
    {
        return view('show-post', ['post' => $post]);
    }

    public function store(Request $request): RedirectResponse
    {
        if (!Auth::check()) {
            abort(403);
        }
        Post::create([
            ...$request->validate([
                'title' => 'required|string|max:255|no_forbidden_words',
                'content' => 'required|string|max:5000|no_forbidden_words',
                'category_id' => 'required|exists:categories,id',
                'image' => 'nullable|image|max:2048',
            ]),
            'user_id' => Auth::id(),
            'image' => $request->hasFile('image') ? $request->file('image')->store('posts', 'public_uploads') : null
        ]);

        return to_route('posts.view');
    }

    public function destroy(Post $post): RedirectResponse
    {
        Gate::authorize('modify-post', $post);
        $post->delete();
        return to_route('posts.view');
    }

    public function edit(Post $post): View
    {
        Gate::authorize('modify-post', $post);
        return view('edit-post', ['post' => $post, 'categories' => Category::all()]);
    }

    public function update(Request $request, Post $post): RedirectResponse
    {
        Gate::authorize('modify-post', $post);

        $validatedData = $request->validate([
            'title' => 'required|string|max:255|no_forbidden_words',
            'content' => 'required|string|no_forbidden_words',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public_uploads');
            $validatedData['image'] = $imagePath;

            if ($post->image) {
                Storage::disk('public_uploads')->delete($post->image);
            }
        }
        $post->update($validatedData);

        return redirect()->route('post.show', $post);
    }
}
