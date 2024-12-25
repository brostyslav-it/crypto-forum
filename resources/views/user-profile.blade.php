@php
    use App\Models\Dislike;
    use App\Models\Like;
    use Illuminate\Support\Facades\DB;
    $postsIds = $user->posts->pluck('id')->all();
    $title = $current ? 'Your' : $user->name . '\'s';
@endphp
<x-layout>
    <x-slot:title>{{ $title }} Profile</x-slot>

    <div class="w-full bg-gray-100 flex items-center justify-center mt-4">
        <div class="w-full max-w-5xl bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-4xl font-bold text-center text-gray-700 mb-8">{{ $title }} Profile</h1>

            <div class="flex flex-col lg:flex-row items-center lg:items-start justify-center lg:space-x-12">
                <div class="mb-8 lg:mb-0">
                    <img src="/{{ $user->avatar }}"
                         alt="Profile Picture"
                         class="w-48 h-48 lg:w-56 lg:h-56 rounded-full object-cover border-8 border-gray-300 shadow-lg">
                </div>

                <div class="text-center lg:text-left w-full lg:w-3/5">
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800">Name</h2>
                        <p class="text-gray-600 text-lg">{{ $user->name }}</p>
                    </div>

                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800">Email</h2>
                        <p class="text-gray-600 text-lg">{{ $user->email }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                        <div
                            class="bg-blue-50 rounded-lg shadow p-3 text-center h-24 flex flex-col justify-center hover:shadow-md hover:bg-blue-100 transition">
                            <h3 class="text-sm font-bold text-blue-600">Posts</h3>
                            <p class="text-gray-800 font-semibold text-lg">{{ $user->posts->count() }}</p>
                        </div>

                        <div
                            class="bg-yellow-50 rounded-lg shadow p-3 text-center h-24 flex flex-col justify-center hover:shadow-md hover:bg-yellow-100 transition">
                            <h3 class="text-sm font-bold text-yellow-600">Comments</h3>
                            <p class="text-gray-800 font-semibold text-lg">{{ $user->comments->count() }}</p>
                        </div>

                        <div
                            class="bg-green-50 rounded-lg shadow p-3 text-center h-24 flex flex-col justify-center hover:shadow-md hover:bg-green-100 transition">
                            <h3 class="text-sm font-bold text-green-600">Likes Sent</h3>
                            <p class="text-gray-800 font-semibold text-lg">{{ $user->likes->count() }}</p>
                        </div>

                        <div
                            class="bg-red-50 rounded-lg shadow p-3 text-center h-24 flex flex-col justify-center hover:shadow-md hover:bg-red-100 transition">
                            <h3 class="text-sm font-bold text-red-600">Dislikes Sent</h3>
                            <p class="text-gray-800 font-semibold text-lg">{{ $user->dislikes->count() }}</p>
                        </div>

                        <div
                            class="bg-indigo-50 rounded-lg shadow p-3 text-center h-24 flex flex-col justify-center hover:shadow-md hover:bg-indigo-100 transition">
                            <h3 class="text-sm font-bold text-indigo-600">Post Likes</h3>
                            <p class="text-gray-800 font-semibold text-lg">{{ Like::whereIn('post_id', $postsIds)->count() }}</p>
                        </div>

                        <div
                            class="bg-purple-50 rounded-lg shadow p-3 text-center h-24 flex flex-col justify-center hover:shadow-md hover:bg-purple-100 transition">
                            <h3 class="text-sm font-bold text-purple-600">Post Dislikes</h3>
                            <p class="text-gray-800 font-semibold text-lg">{{ Dislike::whereIn('post_id', $postsIds)->count() }}</p>
                        </div>
                    </div>

                    @if($current)
                        <div class="mt-8">
                            <a href="{{ route('profile.edit.view') }}"
                               class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition">
                                Edit Profile
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="w-full max-w-4xl bg-white rounded-lg shadow-md p-6 mt-4 mb-6 mx-auto">
        <h1 class="text-4xl font-bold text-center text-gray-700 mb-8">{{ $title }} Posts</h1>

        @if ($user->posts->isEmpty())
            <p class="text-center text-gray-500 text-lg">No posts available.</p>
        @else
            @foreach($user->posts as $post)
                @php
                    $post->popularity_score = DB::select('CALL CalculatePostPopularity(?)', [$post->id])[0]->score ?? 0;
                @endphp
                <x-post :post="$post"/>
            @endforeach
        @endif
    </div>
</x-layout>
