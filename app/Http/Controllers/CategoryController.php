<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    public function create(): View
    {
        Gate::authorize('create-category');
        return view('category-create');
    }

    public function store(): RedirectResponse
    {
        Gate::authorize('create-category');

        Category::create(request()->validate([
            'name' => 'required|max:255|unique:categories|no_forbidden_words',
        ]));

        return to_route('posts.view');
    }
}
