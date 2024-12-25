<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    protected $guarded = [];

    protected static function booted(): void
    {
        static::created(function ($post) {
            DB::table('action_logs')->insert([
                'action_type' => 'INSERT',
                'table_name' => 'posts',
                'action_description' => 'Inserted a new post with ID ' . $post->id . ' titled ' . $post->title,
                'created_at' => now(),
            ]);
        });

        static::updated(function ($post) {
            DB::table('action_logs')->insert([
                'action_type' => 'UPDATE',
                'table_name' => 'posts',
                'action_description' => 'Updated post with ID ' . $post->id . ' from ' . $post->getOriginal('title') . ' to ' . $post->title,
                'created_at' => now(),
            ]);
        });

        static::deleted(function ($post) {
            DB::table('action_logs')->insert([
                'action_type' => 'DELETE',
                'table_name' => 'posts',
                'action_description' => 'Deleted post with ID ' . $post->id . ' titled ' . $post->title,
                'created_at' => now(),
            ]);
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    public function dislikes(): HasMany
    {
        return $this->hasMany(Dislike::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }
}
