<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function showProfile(): View|RedirectResponse
    {
        if (!Auth::check()) {
            return to_route('login.view');
        }

        return view('user-profile', ['user' => Auth::user(), 'current' => true]);
    }

    public function showEditProfile(): View|RedirectResponse
    {
        if (!Auth::check()) {
            return to_route('login.view');
        }

        return view('edit-profile');
    }

    public function update(): RedirectResponse
    {
        $validatedUser = request()->validate([
            'email' => 'required|string|email|max:255|unique:users,email,' . Auth::id(),
            'name' => 'required|string|max:255|no_forbidden_words',
            'image' => 'nullable|image|max:8092',
        ]);
        $user = Auth::user();

        if (request()->hasFile('image')) {
            if ($user->avatar) {
                Storage::disk('public_uploads')->delete($user->avatar);
            }

            $user->avatar = request()->file('image')->store('avatars', 'public_uploads');
            unset($validatedUser['image']);
        }
        $user->update($validatedUser);

        return to_route('profile.view');
    }

    public function showUserProfile(User $user): View|RedirectResponse
    {
        if ($user->id === Auth::id()) {
            return to_route('profile.view');
        }

        return view('user-profile', ['user' => $user, 'current' => false]);
    }

    public function topActiveUsers(): View|RedirectResponse
    {
        if (!Auth::check()) {
            return to_route('login.view');
        }

        return view('most-active-users', ['users' => User::withCount(['posts', 'comments', 'likes', 'dislikes'])
            ->having('posts_count', '>', 0)
            ->orderByDesc('posts_count')
            ->orderByDesc('comments_count')
            ->orderByDesc('likes_count')
            ->orderBy('dislikes_count')
            ->limit(10)
            ->get()
        ]);
    }
}
