<?php

namespace App\Http\Controllers;

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

        return view('profile');
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
}
