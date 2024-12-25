<header class="w-full bg-gray-900 text-white shadow-lg">
    <div class="container mx-auto px-6 py-6 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <a href="/"><img src="/logo/btc.png" alt="Logo" class="w-10 h-10 object-cover"></a>
            <a href="/" class="text-3xl font-extrabold tracking-wide text-yellow-500 hover:text-yellow-400 transition">Crypto Forum</a>
        </div>

        <button class="block lg:hidden focus:outline-none" id="nav-toggle">
            <svg class="w-[45px] h-[45px] text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="aqua" stroke-linecap="round" stroke-width="2" d="M5 7h14M5 12h14M5 17h14"/>
            </svg>
        </button>

        <nav class="hidden lg:flex items-center space-x-6">
            <x-nav-link-desktop href="{{ route('posts.view') }}">Posts</x-nav-link-desktop>
            @if (auth()->check())
                <x-nav-link-desktop href="{{ route('profile.view') }}" >Profile</x-nav-link-desktop>
                <x-nav-link-desktop href="{{ route('post.view') }}">Create a post</x-nav-link-desktop>
                @can('create-category')
                    <x-nav-link-desktop href="{{ route('category.create') }}">Create a category</x-nav-link-desktop>
                @endcan
                <x-nav-link-desktop href="{{ route('top-users.show') }}">Most active users</x-nav-link-desktop>
                <form action="{{ route('logout.post') }}" method="POST" class="inline">
                    @csrf
                    <button class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md transition text-lg">Logout</button>
                </form>
            @else
                <x-nav-link-desktop href="{{ route('login.view') }}">Login</x-nav-link-desktop>
                <x-nav-link-desktop href="{{ route('register.view') }}">Register</x-nav-link-desktop>
            @endif
        </nav>
    </div>

    <div class="lg:hidden bg-gray-800" id="mobile-menu" style="display: none;">
        <nav class="space-y-4 px-6 py-4">
            <x-nav-link-mobile href="{{ route('posts.view') }}">Posts</x-nav-link-mobile>
            @if (auth()->check())
                <x-nav-link-mobile href="{{ route('profile.view') }}">Profile</x-nav-link-mobile>
                <x-nav-link-mobile href="{{ route('post.view') }}">Create a post</x-nav-link-mobile>
                @can('create-category')
                    <x-nav-link-mobile href="{{ route('category.create') }}">Create a category</x-nav-link-mobile>
                @endcan
                <x-nav-link-mobile  href="{{ route('top-users.show') }}">Most active users</x-nav-link-mobile>
                <form action="{{ route('logout.post') }}" method="POST">
                    @csrf
                    <button class="bg-red-600 hover:bg-red-700 text-white font-semibold py-2 px-4 rounded-md transition text-xl">Logout</button>
                </form>
            @else
                <x-nav-link-mobile href="{{ route('login.view') }}">Login</x-nav-link-mobile>
                <x-nav-link-mobile href="{{ route('register.view') }}">Register</x-nav-link-mobile>
            @endif
        </nav>
    </div>
</header>
