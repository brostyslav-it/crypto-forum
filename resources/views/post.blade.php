<x-layout>
    <x-slot:title>Create Post</x-slot>

    <div class="w-full max-w-4xl bg-white rounded-lg shadow-md p-6 mt-6 mx-auto">
        <h1 class="text-2xl font-bold text-center text-gray-700 mb-6">Create Post</h1>

        <form method="POST" action="{{ route('post.post') }}" enctype="multipart/form-data">
            @csrf

            <div class="mb-4">
                <x-label for="title">Title</x-label>
                <x-input type="text" id="title" name="title" value="{{ old('title') }}" required/>
                @error('title')
                <x-form-error>{{ $message }}</x-form-error>
                @enderror
            </div>

            <div class="mb-4">
                <x-label for="content">Content</x-label>
                <textarea id="content" name="content" rows="5" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>{{ old('content') }}</textarea>
                @error('content')
                <x-form-error>{{ $message }}</x-form-error>
                @enderror
            </div>

            <div class="mb-4">
                <x-label for="category_id">Category</x-label>
                <select id="category_id" name="category_id" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="" disabled selected>Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                <x-form-error>{{ $message }}</x-form-error>
                @enderror
            </div>

            <x-file-input>Post Image (Optional)</x-file-input>

            <div class="mt-6 flex justify-between">
                <x-submit-button>Create Post</x-submit-button>
            </div>
        </form>
    </div>
</x-layout>
