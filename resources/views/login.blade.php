<x-layout>
    <x-slot:title>Login</x-slot>
    
    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6 mt-6">
        <h1 class="text-2xl font-bold text-center text-gray-700 mb-6">Login</h1>

        @error('auth_failed')
            <x-form-error>{{ $message }}</x-form-error>
        @enderror

        <form method="POST" action="{{ route('login') }}" class="mt-4">
            @csrf
    
            <div class="mb-4">
                <x-label for="email">Email</x-label>
                <x-input type="email" id="email" name="email" value="{{ old('email') }}" required/>
                @error('email')
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
    
            <div class="mt-6">
                <x-submit-button>Login</x-submit-button>
            </div>
        </form>
    </div>    
</x-layout>
