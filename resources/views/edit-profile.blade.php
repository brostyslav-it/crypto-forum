<x-layout>
    <x-slot:title>Edit Profile</x-slot>

    <div class="w-full max-w-4xl bg-white rounded-lg shadow-md p-8 mt-10 mx-auto">
        <h1 class="text-3xl font-bold text-center text-gray-700 mb-8">Edit Profile</h1>

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-6">
                <x-label for="email">Email</x-label>
                <x-input type="email" id="email" name="email" value="{{ auth()->user()->email }}" required/>
                @error('email')
                <x-form-error>{{ $message }}</x-form-error>
                @enderror
            </div>

            <div class="mb-6">
                <x-label for="name">Name</x-label>
                <x-input type="text" id="name" name="name" value="{{ auth()->user()->name }}" required/>
                @error('name')
                <x-form-error>{{ $message }}</x-form-error>
                @enderror
            </div>

            <div class="mb-6">
                <x-label for="image">Avatar</x-label>
                <div class="flex items-center space-x-4">
                    <img id="avatar-preview" src="/{{ auth()->user()->avatar }}" alt="Current Avatar"
                         class="w-20 h-20 rounded-full object-cover border border-gray-300">
                    <x-file-input>Change Avatar</x-file-input>
                </div>
                @error('avatar')
                <x-form-error>{{ $message }}</x-form-error>
                @enderror
            </div>

            <div class="mt-8 text-center">
                <x-submit-button>Save Changes</x-submit-button>
            </div>
        </form>
    </div>
</x-layout>
