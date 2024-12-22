<x-layout>
    <x-slot:title>Posts</x-slot>

    <div class="w-full max-w-4xl bg-white rounded-lg shadow-md p-6 mt-6 mx-auto">
        <form method="GET" action="{{ route('posts.view') }}" class="mb-6">
            <div class="flex items-center">
                <input type="text" name="search" value="{{ request('search') }}"
                       class="border border-gray-300 rounded-md p-2 w-full" placeholder="Search for posts...">
                <button type="submit" class="ml-2 p-2 bg-gray-900 text-white rounded-md">Search</button>
            </div>
        </form>

        @if($result = request()->input('search'))
            <h1 class="text-3xl font-bold text-center text-gray-700 mb-6">Search results for "{{ $result }}"</h1>
        @else
            <h1 class="text-3xl font-bold text-center text-gray-700 mb-6">Posts by Category</h1>
        @endif

        @if(!$categories->isEmpty())
            @foreach($categories as $category)
                <div class="mb-8">
                    <x-category>{{ $category->name }}</x-category>

                    @if ($category->posts->isEmpty())
                        <p class="text-center text-gray-500 text-lg">No posts available in this category.</p>
                    @else
                        @foreach($category->posts as $post)
                            <x-post :post="$post"/>
                        @endforeach
                    @endif
                </div>
            @endforeach
        @else
            <h3 class="text-xl font-bold text-center italic text-red-700 mb-6 mt-6">There is no posts or categories.</h3>
        @endif
    </div>
</x-layout>
