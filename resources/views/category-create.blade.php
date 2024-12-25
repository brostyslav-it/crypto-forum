<x-layout>
    <x-slot:title>Create Category</x-slot>

    <div class="w-full max-w-md bg-white rounded-lg shadow-md p-6 mt-6">
        <h1 class="text-2xl font-bold text-center text-gray-700 mb-6">Create Category</h1>

        <form method="POST" action="{{ route('category.store') }}" class="mt-4">
            @csrf

            <div class="mb-4">
                <x-label for="name">Category Name</x-label>
                <x-input type="text" id="name" name="name" value="{{ old('name') }}" required/>
                @error('name')
                <x-form-error>{{ $message }}</x-form-error>
                @enderror
            </div>

            <div class="mt-6">
                <x-submit-button>Create Category</x-submit-button>
            </div>
        </form>
    </div>
</x-layout>
