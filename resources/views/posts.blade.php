<x-layout>
    <x-slot:title>Posts</x-slot>

    <div class="w-full max-w-4xl bg-white rounded-lg shadow-md p-6 mt-6 mx-auto">
        <h1 class="text-3xl font-bold text-center text-gray-700 mb-6">Posts by Category</h1>

        @foreach($categories as $category)
            <div class="mb-8">
                <x-category>{{ $category->name }}</x-category>

                @if ($category->posts->isEmpty())
                    <p class="text-center text-gray-500 text-lg">No posts available in this category.</p>
                @else
                    @foreach($category->posts as $post)
                        <x-post :post="$post" />
                    @endforeach
                @endif
            </div>
        @endforeach
    </div>
</x-layout>
