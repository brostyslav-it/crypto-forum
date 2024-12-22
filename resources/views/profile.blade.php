<x-layout>
    <x-slot:title>Profile</x-slot>

    <div class="min-h-screen bg-gray-100 flex items-center justify-center">
        <div class="w-full max-w-5xl bg-white rounded-lg shadow-lg p-8">
            <h1 class="text-4xl font-bold text-center text-gray-700 mb-8">Your Profile</h1>

            <div class="flex flex-col lg:flex-row items-center lg:items-start justify-center lg:space-x-12">
                <div class="mb-8 lg:mb-0">
                    <img src="/{{ auth()->user()->avatar }}"
                         alt="Profile Picture"
                         class="w-48 h-48 lg:w-56 lg:h-56 rounded-full object-cover border-8 border-gray-300 shadow-lg">
                </div>

                <div class="text-center lg:text-left w-full lg:w-3/5">
                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800">Name</h2>
                        <p class="text-gray-600 text-lg">{{ auth()->user()->name }}</p>
                    </div>

                    <div class="mb-6">
                        <h2 class="text-2xl font-semibold text-gray-800">Email</h2>
                        <p class="text-gray-600 text-lg">{{ auth()->user()->email }}</p>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                        <div class="bg-blue-50 rounded-lg shadow p-4 text-center">
                            <h3 class="text-xl font-bold text-blue-600">Posts</h3>
                            <p class="text-gray-700 text-lg">{{ auth()->user()->posts->count() }}</p>
                        </div>

                        <div class="bg-green-50 rounded-lg shadow p-4 text-center">
                            <h3 class="text-xl font-bold text-green-600">Followers</h3>
                            <p class="text-gray-700 text-lg">{{ $stats['followers'] ?? 0 }}</p>
                        </div>

                        <div class="bg-yellow-50 rounded-lg shadow p-4 text-center">
                            <h3 class="text-xl font-bold text-yellow-600">Comments</h3>
                            <p class="text-gray-700 text-lg">{{ auth()->user()->comments->count() }}</p>
                        </div>
                    </div>

                    <div class="mt-8">
                        <a href="{{ route('profile.edit.view') }}"
                           class="inline-block bg-blue-600 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-700 transition">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
