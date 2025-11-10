<nav class="bg-gradient-to-r from-blue-50 to-indigo-100 shadow-lg px-6 py-4">
    <div class="max-w-7xl mx-auto flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center space-x-3">
            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center">
                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-800 hover:text-blue-600 transition">
                BookLibrary
            </a>
        </div>

        <!-- Navigation Links -->
        <div class="hidden md:flex items-center space-x-8">
            <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">Home</a>
            <a href="{{ route('books.index') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">Books</a>
            <a href="{{ route('about') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">About</a>
            <a href="{{ route('contact') }}" class="text-gray-700 hover:text-blue-600 font-medium transition">Contact</a>
        </div>

        <!-- Auth Buttons -->
        <div class="flex items-center space-x-4">
            @auth
                @if(auth()->user()->IsAdmin())
                    <a href="{{ route('admin.dashboard') }}" class="text-purple-600 hover:text-purple-800 font-medium">Admin</a>
                @endif
                <a href="{{ route('cart') }}" class="relative text-gray-700 hover:text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9"/>
                    </svg>
                </a>
                <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition font-medium">
                    Dashboard
                </a>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-500 to-indigo-600 text-white px-6 py-2 rounded-lg hover:from-blue-600 hover:to-indigo-700 transition font-medium shadow-md">
                    Register
                </a>
                <a href="{{ route('login') }}" class="bg-white text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-50 transition font-medium border border-gray-200 shadow-sm">
                    Login
                </a>
            @endauth
        </div>
    </div>
</nav>
