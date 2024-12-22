<div class="mb-6 bg-white rounded-lg shadow-lg p-6 border-2 border-gray-900">
    <h2 class="text-2xl font-bold text-gray-800 mb-3">
        {{ $post->title }}
    </h2>

    <p class="text-gray-600 mb-4">
        {{ Str::limit($post->content, 150) }}
        @if(strlen($post->content) > 150)
            <span class="text-blue-500 font-semibold">... <a
                    href="{{ route('post.show', $post->id) }}">Read more</a></span>
        @endif
    </p>

    <div class="mb-4">
        @if($post->tags->isEmpty())
            <p class="text-gray-500 italic">No tags available for this post.</p>
        @else
            <h3 class="text-sm font-medium text-gray-700 mb-2">Tags:</h3>
            <div class="flex flex-wrap gap-2">
                @foreach($post->tags as $tag)
                    <span class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-sm font-semibold">
                    {{ $tag->name }}
                </span>
                @endforeach
            </div>
        @endif
    </div>

    <div class="flex items-center space-x-4 mb-4">
        <div class="flex items-center space-x-1 text-gray-500">
            <section id="like-for-{{ $post->id }}">
                @if(!auth()->check())
                    <x-login-link><x-like-empty/></x-login-link>
                @elseif(auth()->user()->likes->contains('post_id', $post->id))
                    <x-like-filled onclick="like({{ $post->id }})"/>
                @else
                    <x-like-empty onclick="like({{ $post->id }})"/>
                @endif
            </section>
            <span id="like-count-{{ $post->id }}">{{ $post->likes->count() }}</span>
        </div>
        <div class="flex items-center space-x-1 text-gray-500">
            <section id="dislike-for-{{ $post->id }}">
                @if(!auth()->check())
                    <x-login-link><x-dislike-empty/></x-login-link>
                @elseif(auth()->user()->dislikes->contains('post_id', $post->id))
                    <x-dislike-filled onclick="dislike({{ $post->id }})"/>
                @else
                    <x-dislike-empty onclick="dislike({{ $post->id }})"/>
                @endif
            </section>
            <span id="dislike-count-{{ $post->id }}">{{ $post->dislikes->count() }}</span>
        </div>
        <div class="flex items-center space-x-1 text-gray-500">
            <x-comment/>
            <span>{{ $post->comments->count() }}</span>
        </div>
    </div>

    @if($post->image)
        <div class="mb-4">
            <span class="text-gray-500">This post has an image</span>
        </div>
    @endif

    <a href="{{ route('post.show', $post->id) }}" class="text-blue-500 font-semibold">View Full Post</a>
</div>
