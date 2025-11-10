<section class="relative overflow-hidden bg-gradient-to-br from-blue-50 via-indigo-50 to-purple-50 py-20">
    <div class="absolute inset-0 bg-white/20"></div>
    <div class="relative max-w-7xl mx-auto px-6 text-center">
        <div class="mb-8">
            <h1 class="text-5xl md:text-6xl font-bold text-gray-800 mb-6 leading-tight">
                Discover the Joy of 
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600">
                    Reading
                </span>
            </h1>
            <p class="text-xl text-gray-600 mb-8 max-w-3xl mx-auto leading-relaxed">
                Books open doors to new worlds, ideas, and endless adventures.
                Start your journey today and explore a universe of knowledge.
            </p>
        </div>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-12">
            <a href="{{ route('books.index') }}" 
               class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-4 rounded-xl shadow-lg hover:from-blue-700 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105 font-semibold text-lg">
                Browse Books
            </a>
            @guest
            <a href="{{ route('register') }}" 
               class="bg-white text-gray-700 px-8 py-4 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 border border-gray-200 font-semibold text-lg">
                Get Started
            </a>
            @endguest
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg">
                <div class="text-3xl font-bold text-blue-600 mb-2">1000+</div>
                <div class="text-gray-600 font-medium">Books Available</div>
            </div>
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg">
                <div class="text-3xl font-bold text-indigo-600 mb-2">500+</div>
                <div class="text-gray-600 font-medium">Active Readers</div>
            </div>
            <div class="bg-white/70 backdrop-blur-sm rounded-2xl p-6 shadow-lg">
                <div class="text-3xl font-bold text-purple-600 mb-2">50+</div>
                <div class="text-gray-600 font-medium">Categories</div>
            </div>
        </div>
    </div>
</section>
