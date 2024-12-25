<x-layout>
    <x-slot:title>Top Users</x-slot>

    <div class="bg-gray-100 flex items-center justify-center mt-4">
        <div class="w-full max-w-5xl bg-white rounded-lg shadow-lg p-4 sm:p-8">
            <h1 class="text-2xl sm:text-3xl font-bold text-center text-gray-700 mb-4 sm:mb-6">Top 10 Active Users</h1>

            <!-- Desktop Table -->
            <div class="hidden lg:block overflow-x-auto">
                <table class="w-full border-collapse border border-gray-300 rounded-lg">
                    <thead>
                    <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                        <th class="py-3 px-6 text-left">#</th>
                        <th class="py-3 px-6 text-left">Avatar</th>
                        <th class="py-3 px-6 text-left">Name</th>
                        <th class="py-3 px-6 text-left">Posts</th>
                        <th class="py-3 px-6 text-left">Comments</th>
                        <th class="py-3 px-6 text-left">Likes Sent</th>
                        <th class="py-3 px-6 text-left">Dislikes Sent</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $index => $user)
                        <tr class="hover:bg-gray-100 transition">
                            <td class="py-3 px-6">{{ $index + 1 }}</td>
                            <td class="py-3 px-6">
                                <a href="{{ route('profile.show', $user->id) }}">
                                    <img src="/{{ $user->avatar }}" alt="Avatar" class="w-10 h-10 rounded-full">
                                </a>
                            </td>
                            <td class="py-3 px-6 font-bold text-gray-800">
                                <a href="{{ route('profile.show', $user->id) }}">{{ $user->name }}</a>
                            </td>
                            <td class="py-3 px-6">{{ $user->posts_count }}</td>
                            <td class="py-3 px-6">{{ $user->comments->count() }}</td>
                            <td class="py-3 px-6">{{ $user->likes->count() }}</td>
                            <td class="py-3 px-6">{{ $user->dislikes->count() }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="block lg:hidden space-y-4 mt-4">
                @foreach($users as $index => $user)
                    <div class="bg-white border border-gray-200 rounded-lg shadow p-4 flex items-center space-x-4">
                        <div>
                            <a href="{{ route('profile.show', $user->id) }}">
                                <img src="/{{ $user->avatar }}" alt="Avatar" class="w-14 h-14 rounded-full">
                            </a>
                        </div>
                        <div class="flex-1">
                            <h2 class="font-bold text-gray-800">
                                <a href="{{ route('profile.show', $user->id) }}">{{ $user->name }}</a>
                            </h2>
                            <p class="text-sm text-gray-600">Rank: <span class="font-semibold">{{ $index + 1 }}</span></p>
                            <div class="mt-2 space-y-1 text-sm">
                                <p class="text-gray-600"><strong>Posts:</strong> {{ $user->posts_count }}</p>
                                <p class="text-gray-600"><strong>Comments:</strong> {{ $user->comments->count() }}</p>
                                <p class="text-gray-600"><strong>Likes Sent:</strong> {{ $user->likes->count() }}</p>
                                <p class="text-gray-600"><strong>Dislikes Sent:</strong> {{ $user->dislikes->count() }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-layout>
