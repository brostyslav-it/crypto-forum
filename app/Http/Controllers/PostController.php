<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function index(): View|RedirectResponse
    {
        if (!Auth::check()) {
            return to_route('login.view');
        }

        return view('post', ['categories' => Category::all()]);
    }

    public function showAll(): View
    {
        return view('posts', ['categories' => Category::all()]);
    }

    public function show(Post $post): View
    {
        return view('show-post', ['post' => $post]);
    }

    public function store(Request $request): RedirectResponse
    {
        if (!Auth::check()) {
            abort(403);
        }
        $validatedPost = $request->validate([
            'title' => 'required|string|max:255|no_forbidden_words',
            'content' => 'required|string|max:5000|no_forbidden_words',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|max:2048',
            'tags' => 'nullable|string|no_forbidden_words',
        ]);

        $post = Post::create([
            'title' => $validatedPost['title'],
            'content' => $validatedPost['content'],
            'category_id' => $validatedPost['category_id'],
            'user_id' => Auth::id(),
            'image' => $request->hasFile('image') ? $request->file('image')->store('posts', 'public_uploads') : null
        ]);

        if (!empty($validatedPost['tags'])) {
            $post->tags()->sync($this->mapTagsForPost($validatedPost['tags']));
        }

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
            'tags' => 'nullable|string|no_forbidden_words',
        ]);
        $tags = $validatedData['tags'];
        unset($validatedData['tags']);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public_uploads');
            $validatedData['image'] = $imagePath;

            if ($post->image) {
                Storage::disk('public_uploads')->delete($post->image);
            }
        }
        $post->update($validatedData);

        if (!empty($tags)) {
            $post->tags()->sync($this->mapTagsForPost($tags));
        }

        return redirect()->route('post.show', $post);
    }

    protected function mapTagsForPost(string $tags): Collection
    {
        return collect(array_map(
            fn(string $tag) => Str::lower(trim($tag)),
            explode(',', $tags)
        ))->map(fn(string $name) => Tag::firstOrCreate(['name' => $name])
        )->pluck('id');
    }
}
