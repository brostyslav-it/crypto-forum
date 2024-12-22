<?php

namespace App\Providers;

use App\Models\Comment;
use App\Models\ForbiddenWord;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('delete-comment', fn(User $user, Comment $comment) => ($user->id === $comment->user_id) || $user->is_admin);
        Gate::define('modify-post', fn(User $user, Post $post) => ($user->id === $post->user_id) || $user->is_admin);
        Gate::define('create-category', fn(User $user) => $user->is_admin || $user->posts()->count() >= 10);

        Validator::extend('no_forbidden_words', function ($attribute, $value, $parameters, $validator) {
            $forbiddenWords = ForbiddenWord::all()->pluck('word')->toArray();

            foreach ($forbiddenWords as $forbiddenWord) {
                if (stripos($value, $forbiddenWord) !== false) {
                    return false;
                }
            }

            return true;
        });

        Validator::replacer('no_forbidden_words', function($message, $attribute, $rule, $parameters) {
            return 'Your text contains a forbidden word';
        });
    }
}
