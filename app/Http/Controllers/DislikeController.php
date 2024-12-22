<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class DislikeController extends Controller
{
    public function store(Post $post): JsonResponse|RedirectResponse
    {
        if (!Auth::check()) {
            abort(403);
        }
        $likeDeleted = false;

        if ($post->dislikes()->where('user_id', Auth::id())->exists()) {
            $post->dislikes()->where('user_id', Auth::id())->delete();
            $disliked = false;
        } else {
            $post->dislikes()->create(['user_id' => Auth::id()]);

            if ($post->likes()->where('user_id', Auth::id())->exists()) {
                $post->likes()->where('user_id', Auth::id())->delete();
                $likeDeleted = true;
            }

            $disliked = true;
        }

        return response()->json([
            'dislikes' => $post->dislikes()->count(),
            'disliked' => $disliked,
            'like_deleted' => $likeDeleted,
            'likes' => $post->likes()->count(),
        ]);
    }
}
