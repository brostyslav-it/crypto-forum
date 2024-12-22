<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected const DEFAULT_AVATAR = 'avatars/default.png';

    public function registerView(): View|RedirectResponse
    {
        if (Auth::check()) {
            return to_route('posts.view');
        }

        return view('register');
    }

    public function loginView(): View|RedirectResponse
    {
        if (Auth::check()) {
            return to_route('posts.view');
        }

        return view('login');
    }

    public function register(): RedirectResponse
    {
        $validatedUser = request()->validate([
            'email' => 'required|string|email|max:255|unique:users',
            'name' => 'required|string|max:255|no_forbidden_words',
            'image' => 'nullable|image|max:8092',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $validatedUser['avatar'] = request()->hasFile('image')
            ? request()->file('image')->store('avatars', 'public_uploads')
            : self::DEFAULT_AVATAR;
        unset($validatedUser['image']);

        Auth::login(User::create($validatedUser));

        return to_route('profile.view');
    }

    public function login(): RedirectResponse
    {
        if (Auth::attempt(request()->validate([
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:8',
        ]))) {
            return to_route('profile.view');
        }

        return redirect()->back()->withErrors(['auth_failed' => 'Wrong email or password']);
    }

    public function logout(): RedirectResponse
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return to_route('login.view');
    }
}
