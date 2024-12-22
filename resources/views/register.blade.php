<x-layout>
    <x-slot:title>Register</x-slot>

    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6 mt-6">
        <h1 class="text-2xl font-bold text-center text-gray-700 mb-6">Register</h1>

        <form method="POST" action="{{ route('register.post') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <x-label for="email">Email</x-label>
                <x-input type="email" id="email" name="email" value="{{ old('email') }}" required/>
                @error('email')
                <x-form-error>{{ $message }}</x-form-error>
                @enderror
            </div>

            <div class="mb-4">
                <x-label for="name">Name</x-label>
                <x-input type="text" id="name" name="name" value="{{ old('name') }}" required/>
                @error('name')
                <x-form-error>{{ $message }}</x-form-error>
                @enderror
            </div>

            <div class="mb-4">
                <x-label for="password">Password</x-label>
                <x-input type="password" id="password" name="password" required/>
                @error('password')
                <x-form-error>{{ $message }}</x-form-error>
                @enderror
            </div>

            <div class="mb-4">
                <x-label for="password_confirmation">Confirm Password</x-label>
                <x-input type="password" id="password_confirmation" name="password_confirmation" required/>
            </div>

            <x-file-input>Avatar</x-file-input>

            <div class="mt-6">
                <x-submit-button>Register</x-submit-button>
            </div>
        </form>
    </div>
</x-layout>
