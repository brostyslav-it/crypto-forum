<header class="w-full bg-gray-900 text-white shadow-lg">
    <div class="container mx-auto px-6 py-6 flex justify-between items-center">
        <div class="flex items-center space-x-4">
            <a href="/">
                <img src="/logo/btc.png" alt="Logo" class="w-10 h-10 object-cover">
            </a>
            <a href="/" class="text-3xl font-extrabold tracking-wide">CryptoForum</a>
        </div>

        <button class="block lg:hidden focus:outline-none" id="nav-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="35" height="35" viewBox="0 0 50 50"
                 style="fill:#FFFFFF;">
                <path
                    d="M 0 7.5 L 0 12.5 L 50 12.5 L 50 7.5 Z M 0 22.5 L 0 27.5 L 50 27.5 L 50 22.5 Z M 0 37.5 L 0 42.5 L 50 42.5 L 50 37.5 Z"></path>
            </svg>
        </button>

        <nav class="hidden lg:flex items-center space-x-6">
            @if (auth()->check())
                <x-nav-link-desktop href="{{ route('profile.view') }}">Profile</x-nav-link-desktop>
                <x-nav-link-desktop href="{{ route('post.view') }}">Create a post</x-nav-link-desktop>
                <form action="{{ route('logout.post') }}" method="POST" class="inline">
                    @csrf
                    <button class="hover:text-blue-400 transition">Logout</button>
                </form>
            @else
                <x-nav-link-desktop href="{{ route('login.view') }}">Login</x-nav-link-desktop>
                <x-nav-link-desktop href="{{ route('register.view') }}">Register</x-nav-link-desktop>
            @endif
            <x-nav-link-desktop href="{{ route('posts.view') }}">Posts</x-nav-link-desktop>
        </nav>
    </div>

    <div class="lg:hidden bg-gray-800" id="mobile-menu" style="display: none;">
        <nav class="space-y-4 px-6 py-4">
            @if (auth()->check())
                <x-nav-link-mobile href="{{ route('profile.view') }}">Profile</x-nav-link-mobile>
                <x-nav-link-mobile href="{{ route('post.view') }}">Create a post</x-nav-link-mobile>
                <form action="{{ route('logout.post') }}" method="POST">
                    @csrf
                    <button class="hover:text-blue-400 transition">Logout</button>
                </form>
            @else
                <x-nav-link-mobile href="{{ route('login.view') }}">Login</x-nav-link-mobile>
                <x-nav-link-mobile href="{{ route('register.view') }}">Register</x-nav-link-mobile>
            @endif
            <x-nav-link-mobile href="{{ route('posts.view') }}">Posts</x-nav-link-mobile>
        </nav>
    </div>

    <script>
        document.getElementById('nav-toggle').addEventListener('click', function () {
            const mobileMenu = document.getElementById('mobile-menu');
            mobileMenu.style.display = (mobileMenu.style.display === 'none' || mobileMenu.style.display === '') ? 'block' : 'none';
        });
    </script>
</header>
