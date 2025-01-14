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

        <div class="mb-6">
            @if($post->tags->isEmpty())
                <p class="text-gray-500 italic">No tags available for this post.</p>
            @else
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Tags:</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach($post->tags as $tag)
                        <span class="px-3 py-1 bg-gray-200 text-gray-700 rounded-full text-sm font-semibold">
                            {{ $tag->name }}
                        </span>
                    @endforeach
                </div>
            @endif
        </div>

        <div class="bg-yellow-100 p-4 rounded-lg mb-6">
            <b class="text-gray-700 text-xl font-bold">Popularity Score: {{ $post->popularity_score }}</b>
        </div>

        @can('modify-post', $post)
            <div class="bg-blue-100 p-4 rounded-lg mb-6">
                <div class="flex justify-center space-x-10">
                    <a href="{{ route('post.edit', $post->id) }}" class="text-blue-500 hover:text-blue-700">
                        <x-edit/>
                    </a>
                    <form action="{{ route('post.destroy', $post->id) }}" method="POST"
                          onsubmit="return confirm('Are you sure you want to delete this post?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">
                            <x-delete/>
                        </button>
                    </form>
                </div>
            </div>
        @endcan

        <div class="bg-gray-100 p-4 rounded-lg mb-6">
            @csrf
            <div class="flex justify-center space-x-10 text-gray-600">
                <div class="flex items-center gap-2 cursor-pointer transition-shadow">
                    <section id="like-for-{{ $post->id }}">
                        @if(!auth()->check())
                            <x-login-link>
                                <x-like-empty/>
                            </x-login-link>
                        @elseif(auth()->user()->likes->contains('post_id', $post->id))
                            <x-like-filled onclick="like({{ $post->id }})"/>
                        @else
                            <x-like-empty onclick="like({{ $post->id }})"/>
                        @endif
                    </section>
                    <span id="like-count-{{ $post->id }}">{{ $post->likes->count() }}</span>
                </div>

                <div class="flex items-center gap-2">
                    <section id="dislike-for-{{ $post->id }}">
                        @if(!auth()->check())
                            <x-login-link>
                                <x-dislike-empty/>
                            </x-login-link>
                        @elseif(auth()->user()->dislikes->contains('post_id', $post->id))
                            <x-dislike-filled onclick="dislike({{ $post->id }})"/>
                        @else
                            <x-dislike-empty onclick="dislike({{ $post->id }})"/>
                        @endif
                    </section>
                    <span id="dislike-count-{{ $post->id }}">{{ $post->dislikes->count() }}</span>
                </div>

                <div class="flex items-center gap-2">
                    <x-comment/>
                    <span>{{ $post->comments->count() }}</span>
                </div>
            </div>
        </div>

        <div>
            <button onclick="toggleUsersLiked()" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                View Users Who Liked This Post
            </button>
        </div>

        <div id="users-liked-modal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden">
            <div class="bg-white w-11/12 max-w-2xl mx-auto mt-20 p-6 rounded-lg shadow-lg relative">
                <button onclick="toggleUsersLiked()" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700">
                    &times;
                </button>
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Users Who Liked This Post</h3>
                <ul class="space-y-2">
                    @forelse($post->users_liked as $user)
                        <li class="flex items-center space-x-4">
                            <img src="/{{ $user->user_avatar }}" alt="{{ $user->user_name }}" class="w-8 h-8 rounded-full object-cover">
                            <a href="{{ route('profile.show', $user->user_id) }}" class="text-blue-500 hover:underline">
                                {{ $user->user_name }}
                            </a>
                        </li>
                    @empty
                        <p class="text-gray-600">No users have liked this post yet.</p>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="mt-8">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Comments ({{ $post->comments->count() }})</h2>

            @if($post->comments->isEmpty())
                <p class="text-gray-600 italic">No comments yet. Be the first to comment!</p>
            @else
                <div class="space-y-4">
                    @foreach($post->comments as $comment)
                        <div class="bg-gray-100 p-4 rounded-lg flex items-start">
                            <a href="{{ route('profile.show', $comment->user->id) }}">
                                <div class="w-12 h-12 mr-4">
                                    <img src="/{{ $comment->user->avatar }}" alt="User Avatar"
                                         class="w-full h-full rounded-full object-cover">
                                </div>
                            </a>

                            <div class="flex-1">
                                <a href="{{ route('profile.show', $comment->user->id) }}">
                                    <p class="text-gray-800 font-semibold">{{ $comment->user->name }}</p>
                                </a>
                                <p class="text-gray-700">{{ $comment->content }}</p>
                                <p class="text-sm text-gray-500 mt-2">{{ $comment->created_at->diffForHumans() }}</p>
                            </div>

                            @can('delete-comment', $comment)
                                <div class="ml-4">
                                    <form action="{{ route('comment.destroy', $comment->id) }}" method="POST"
                                          onsubmit="return confirm('Are you sure you want to delete this comment?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">
                                            <x-delete/>
                                        </button>
                                    </form>
                                </div>
                            @endcan
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
                        <textarea id="comment" name="content" rows="4"
                                  class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                  required>{{ old('content') }}</textarea>
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
<script>
    function toggleUsersLiked() {
        const modal = document.getElementById('users-liked-modal');
        modal.classList.toggle('hidden');
    }
</script>
