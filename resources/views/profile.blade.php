<x-layout>
    <x-slot:title>Profile</x-slot>

    <div class="min-h-screen bg-gray-100 flex items-center justify-center">
        <div class="w-full max-w-4xl bg-white rounded-lg shadow-md p-6">
            <h1 class="text-3xl font-bold text-center text-gray-700 mb-8">Your Profile</h1>

            <div class="flex flex-col md:flex-row items-center md:items-start justify-center md:space-x-8">
                <!-- Profile Picture -->
                <div class="mb-6 md:mb-0">
                    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('images/default-avatar.png') }}" 
                         alt="Profile Picture" 
                         class="w-32 h-32 md:w-40 md:h-40 rounded-full object-cover border-4 border-gray-300 shadow-md">
                </div>

                <!-- User Information -->
                <div class="text-center md:text-left">
                    <div class="mb-4">
                        <h2 class="text-xl font-semibold text-gray-800">Name</h2>
                        <p class="text-gray-600">{{ auth()->user()->name }}</p>
                    </div>

                    <div class="mb-4">
                        <h2 class="text-xl font-semibold text-gray-800">Email</h2>
                        <p class="text-gray-600">{{ auth()->user()->email }}</p>
                    </div>

                    <div class="mt-6">
                        <a href="{{ route('profile.edit') }}"
                           class="inline-block bg-blue-600 text-white px-6 py-2 rounded-md shadow hover:bg-blue-700 transition">
                            Edit Profile
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>
