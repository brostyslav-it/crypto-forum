<header class="w-full bg-gray-900 text-white shadow-md">
    <div class="container mx-auto px-6 py-4 flex justify-between items-center">
        <a href="/" class="text-2xl font-bold">CryptoForum</a>

        <button class="block lg:hidden focus:outline-none" id="nav-toggle">
            <svg class="w-6 h-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M4 6h16M4 12h16m-7 6h7"/>
            </svg>
        </button>

        <nav class="hidden lg:flex space-x-4" id="nav-menu">
            @if (auth()->check())
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="hover:text-blue-400 transition">Logout</span>
                </form>
            @else
                <x-nav-link-desktop href="{{ route('login_view') }}">Login</x-nav-link-desktop>
                <x-nav-link-desktop href="{{ route('register_view') }}">Register</x-nav-link-desktop>
            @endif
        </nav>
    </div>

    <div class="lg:hidden" id="mobile-menu" style="display: none;">
        <nav class="px-6 py-4 bg-gray-800 space-y-2">
            @if (auth()->check())
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="hover:text-blue-400 transition">Logout</span>
                </form>
            @else
                <x-nav-link-mobile href="{{ route('login_view') }}">Login</x-nav-link-mobile>
                <x-nav-link-mobile href="{{ route('register_view') }}">Register</x-nav-link-mobile>
            @endif
        </nav>
    </div>
</header>
