<x-layout>
    <x-slot:title>Register</x-slot>

    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6 mt-6">
        <h1 class="text-2xl font-bold text-center text-gray-700 mb-6">Register</h1>

        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
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

            <div class="mb-4">
                <label for="avatar" class="block text-gray-700">Avatar</label>
                
                <div class="flex items-center">
                    <label for="avatar" class="cursor-pointer bg-gray-900 text-white py-2 px-4 rounded-md hover:bg-blue-600">
                        Choose File
                    </label>
                    <span id="file-name" class="ml-4 text-gray-500">No file chosen</span>
                </div>
                <input type="file" name="avatar" id="avatar" class="hidden" onchange="updateFileName()">
            </div>

            <div class="mt-6">
                <x-submit-button>Register</x-submit-button>
            </div>
        </form>
    </div>

    <script>
        function updateFileName() {
            const input = document.getElementById('avatar');
            const fileName = input.files.length ? input.files[0].name : 'No file chosen';
            document.getElementById('file-name').textContent = fileName;
        }
    </script>
</x-layout>
