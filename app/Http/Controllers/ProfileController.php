<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

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
}
