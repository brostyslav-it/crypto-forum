<x-layout>
    <x-slot:title>{{ $post->title }}</x-slot>

    <div class="w-full max-w-4xl bg-white rounded-lg shadow-md p-6 mt-6 mx-auto">
        <x-category>{{ $post->category->name }}</x-category>

        <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $post->title }}</h1>

        @if($post->image)
            <div class="mb-4">
                <img src="/{{ $post->image }}" alt="Post Image" class="rounded-lg w-full max-h-96 object-cover">
            </div>
        @endif

        <div class="text-gray-700 leading-7 mb-6">
            {{ $post->content }}
        </div>

        <div class="flex items-center space-x-4 text-gray-600 mb-6">
            <div class="flex items-center gap-2 cursor-pointer transition-shadow">
                <x-like-empty />
                <span>{{ $post->likes->count() }}</span>
            </div>

            <div class="flex items-center gap-2">
                <x-dislike-empty />
                <span>{{ $post->dislikes->count() }}</span>
            </div>

            <div class="flex items-center gap-2">
                <x-comment />
                <span>{{ $post->comments->count() }}</span>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Comments {{ $post->comments->count() }}</h2>

            @if($post->comments->isEmpty())
                <p class="text-gray-600 italic">No comments yet. Be the first to comment!</p>
            @else
                <div class="space-y-4">
                    @foreach($post->comments as $comment)
                        <div class="bg-gray-100 p-4 rounded-lg flex items-start">
                            <div class="w-12 h-12 mr-4">
                                <img src="/{{ $comment->user->avatar }}" alt="User Avatar" class="w-full h-full rounded-full object-cover">
                            </div>

                            <div class="flex-1">
                                <p class="text-gray-800 font-semibold">{{ $comment->user->name }}</p>
                                <p class="text-gray-700">{{ $comment->content }}</p>
                                <p class="text-sm text-gray-500 mt-2">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        @auth
            <div class="mt-8">
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">Add a Comment</h2>
                <form method="POST" action="{{ route('comment.post') }}">
                    @csrf
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <div class="mb-4">
                        <x-label for="comment">Your Comment</x-label>
                        <textarea id="comment" name="content" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required></textarea>
                        @error('content')
                        <x-form-error>{{ $message }}</x-form-error>
                        @enderror
                    </div>
                    <x-submit-button>Add Comment</x-submit-button>
                </form>
            </div>
        @endauth
    </div>
</x-layout>
