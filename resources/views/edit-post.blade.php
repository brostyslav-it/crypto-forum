<x-layout>
    <x-slot:title>Edit Post</x-slot>

    <div class="w-full max-w-4xl bg-white rounded-lg shadow-md p-6 mt-6 mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-6">Edit Post</h1>

        <form method="POST" action="{{ route('post.update', $post->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <x-label for="title">Title</x-label>
                <input
                    type="text"
                    id="title"
                    name="title"
                    value="{{ old('title', $post->title) }}"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required
                />
                @error('title')
                <x-form-error>{{ $message }}</x-form-error>
                @enderror
            </div>

            <div class="mb-4">
                <x-label for="content">Content</x-label>
                <textarea
                    id="content"
                    name="content"
                    rows="6"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required
                >{{ old('content', $post->content) }}</textarea>
                @error('content')
                <x-form-error>{{ $message }}</x-form-error>
                @enderror
            </div>

            <div class="mb-4">
                <x-label for="tags">Tags (Optional)</x-label>
                <x-input type="text" id="tags" name="tags" value="{{ old('tags', $post->tags->pluck('name')->join(',')) }}" placeholder="btc,eth,sol,scam,dex"/>
                @error('tags')
                <x-form-error>{{ $message }}</x-form-error>
                @enderror
            </div>

            <div class="mb-4">
                <x-label for="category">Category</x-label>
                <select
                    id="category"
                    name="category_id"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    required
                >
                    @foreach($categories as $category)
                        <option
                            value="{{ $category->id }}"
                            {{ $category->id === old('category_id', $post->category_id) ? 'selected' : '' }}
                        >
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                <x-form-error>{{ $message }}</x-form-error>
                @enderror
            </div>

            <div class="mb-4">
                <x-file-input>Update post image</x-file-input>

                @if($post->image)
                    <p class="mt-2 text-sm text-gray-600">Current Image:</p>
                    <img src="/{{ $post->image }}" alt="Post Image" class="rounded-lg w-32 mt-2">
                @endif
                @error('image')
                <x-form-error>{{ $message }}</x-form-error>
                @enderror
            </div>

            <div class="flex justify-end space-x-4 mt-6">
                <a href="{{ route('post.show', $post->id) }}"
                   class="px-4 py-2 text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">Cancel</a>
                <button
                    type="submit"
                    class="px-4 py-2 text-white bg-blue-500 rounded-lg hover:bg-blue-600"
                >
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</x-layout>
