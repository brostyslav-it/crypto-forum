<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function store(Post $post): JsonResponse|RedirectResponse
    {
        if (!Auth::check()) {
            abort(403);
        }
        $dislikeDeleted = false;

        if ($post->likes()->where('user_id', Auth::id())->exists()) {
            $post->likes()->where('user_id', Auth::id())->delete();
            $liked = false;
        } else {
            $post->likes()->create(['user_id' => Auth::id()]);

            if ($post->dislikes()->where('user_id', Auth::id())->exists()) {
                $post->dislikes()->where('user_id', Auth::id())->delete();
                $dislikeDeleted = true;
            }
            $liked = true;
        }

        return response()->json([
            'likes' => $post->likes()->count(),
            'liked' => $liked,
            'dislike_deleted' => $dislikeDeleted,
            'dislikes' => $post->dislikes()->count(),
        ]);
    }
}
