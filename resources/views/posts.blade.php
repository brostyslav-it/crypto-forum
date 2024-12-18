<x-layout>
    <x-slot:title>All Posts</x-slot>

    <div class="w-full max-w-4xl bg-white rounded-lg shadow-md p-6 mt-6 mx-auto">
        <h1 class="text-3xl font-bold text-center text-gray-700 mb-6">All Posts</h1>

        @if ($posts->isEmpty())
            <p class="text-center text-gray-500 text-lg">No posts available at the moment. Be the first to create one!</p>
        @else
            @foreach($posts as $post)
                <div class="mb-6 border-b border-gray-300 pb-6">
                    <h2 class="text-2xl font-bold text-gray-800 mb-3">
                        {{ $post->title }}
                    </h2>
                    <p class="text-gray-600 mb-4">
                        {{ Str::limit($post->content, 150) }}
                        @if(strlen($post->content) > 150)
                            <span class="text-blue-500 font-semibold">... <a href="#">Read more</a></span>
                        @endif
                    </p>

                    <div class="flex items-center space-x-4 mb-4">
                        <div class="flex items-center space-x-1 text-gray-500">
                            <svg class="w-5 h-5 text-red-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
                            </svg>
                            <span>{{ $post->likes_count }}</span>
                        </div>
                        <div class="flex items-center space-x-1 text-gray-500">
                            <svg class="w-5 h-5 text-blue-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"></path>
                            </svg>
                            <span>{{ $post->dislikes_count }}</span>
                        </div>
                        <div class="flex items-center space-x-1 text-gray-500">
                            <svg class="w-5 h-5 text-gray-600" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M3 3h18v2H3zm0 4h18v2H3zm0 4h18v2H3zm0 4h18v2H3zm0 4h18v2H3z"></path>
                            </svg>
                            <span>{{ $post->comments_count }}</span>
                        </div>
                    </div>

                    @if($post->image)
                        <div class="mb-4">
                            <span class="text-gray-500">This post has an image</span>
                        </div>
                    @endif

                    <a href="#" class="text-blue-500 font-semibold">View Full Post</a>
                </div>
            @endforeach
        @endif
    </div>
</x-layout>
