<x-layout>
    <x-slot:title>Database Analytics</x-slot>

    <div class="w-full max-w-6xl bg-white rounded-lg shadow-md p-6 mt-6 mx-auto">
        <!-- Top Posts Section -->
        <section class="mb-10">
            <h1 class="text-2xl font-semibold text-gray-800 mb-4">Top Posts by Likes</h1>
            @if($topPosts->isEmpty())
                <p class="text-gray-600 italic">No posts to display.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300 rounded-lg text-left text-sm">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 border border-gray-300">Post ID</th>
                            <th class="p-3 border border-gray-300">Title</th>
                            <th class="p-3 border border-gray-300">Total Likes</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($topPosts as $post)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 border border-gray-300">{{ $post->post_id }}</td>
                                <td class="p-3 border border-gray-300">{{ $post->post_title }}</td>
                                <td class="p-3 border border-gray-300">{{ $post->total_likes }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>

        <!-- User Activity Section -->
        <section class="mb-10">
            <h1 class="text-2xl font-semibold text-gray-800 mb-4">User Activity</h1>
            @if($userActivity->isEmpty())
                <p class="text-gray-600 italic">No user activity to display.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300 rounded-lg text-left text-sm">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 border border-gray-300">User ID</th>
                            <th class="p-3 border border-gray-300">Name</th>
                            <th class="p-3 border border-gray-300">Total Posts</th>
                            <th class="p-3 border border-gray-300">Likes Given</th>
                            <th class="p-3 border border-gray-300">Comments</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($userActivity as $user)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 border border-gray-300">{{ $user->user_id }}</td>
                                <td class="p-3 border border-gray-300">{{ $user->user_name }}</td>
                                <td class="p-3 border border-gray-300">{{ $user->total_posts }}</td>
                                <td class="p-3 border border-gray-300">{{ $user->total_likes_given }}</td>
                                <td class="p-3 border border-gray-300">{{ $user->total_comments }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>

        <!-- Post Details Section -->
        <section>
            <h1 class="text-2xl font-semibold text-gray-800 mb-4">Post Details</h1>
            @if($postDetails->isEmpty())
                <p class="text-gray-600 italic">No post details to display.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300 rounded-lg text-left text-sm">
                        <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 border border-gray-300">Post ID</th>
                            <th class="p-3 border border-gray-300">Title</th>
                            <th class="p-3 border border-gray-300">Author</th>
                            <th class="p-3 border border-gray-300">Likes</th>
                            <th class="p-3 border border-gray-300">Comments</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($postDetails as $post)
                            <tr class="hover:bg-gray-50">
                                <td class="p-3 border border-gray-300">{{ $post->post_id }}</td>
                                <td class="p-3 border border-gray-300">{{ $post->post_title }}</td>
                                <td class="p-3 border border-gray-300">{{ $post->author_name }}</td>
                                <td class="p-3 border border-gray-300">{{ $post->total_likes }}</td>
                                <td class="p-3 border border-gray-300">{{ $post->total_comments }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </section>
    </div>
</x-layout>
