<div class="mb-6 border-b border-gray-300 pb-6">
    <h2 class="text-2xl font-bold text-gray-800 mb-3">
        {{ $post->title }}
    </h2>
    <p class="text-gray-600 mb-4">
        {{ Str::limit($post->content, 150) }}
        @if(strlen($post->content) > 150)
            <span class="text-blue-500 font-semibold">... <a href="{{ route('post.show', $post->id) }}">Read more</a></span>
        @endif
    </p>

    <div class="flex items-center space-x-4 mb-4">
        <div class="flex items-center space-x-1 text-gray-500">
            <x-like-empty />
            <span>{{ $post->likes->count() }}</span>
        </div>
        <div class="flex items-center space-x-1 text-gray-500">
            <x-dislike-empty />
            <span>{{ $post->dislikes->count() }}</span>
        </div>
        <div class="flex items-center space-x-1 text-gray-500">
            <x-comment />
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
