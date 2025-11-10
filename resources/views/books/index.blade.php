<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Books - BookLibrary</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    <x-navbar />
    <x-flash-message />
    
    <main class="flex-grow py-8">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Our Book Collection</h1>
                <p class="text-gray-600">Discover your next favorite read from our curated selection</p>
            </div>
            
            <!-- Search and Filter -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <form method="GET" class="flex flex-wrap gap-4">
                    <div class="flex-1 min-w-64">
                        <input type="text" name="search" placeholder="Search by title or author..." 
                               value="{{ request('search') }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div class="min-w-48">
                        <select name="category_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" 
                                        {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-8 py-3 rounded-lg hover:from-blue-700 hover:to-indigo-700 transition font-medium">
                        Search
                    </button>
                    @if(request('search') || request('category_id'))
                        <a href="{{ route('books.index') }}" class="bg-gray-200 text-gray-700 px-8 py-3 rounded-lg hover:bg-gray-300 transition font-medium">
                            Clear Filter
                        </a>
                    @endif
                </form>
            </div>
            
            <!-- Books Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                @foreach($books as $book)
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                        <div class="w-full h-80 bg-gray-200 rounded-t-xl overflow-hidden">
                            @if($book->image)
                                <img src="{{ Storage::url($book->image) }}" alt="{{ $book->title }}" class="w-full h-full object-contain bg-white">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center">
                                    <svg class="w-24 h-24 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                </div>
                            @endif
                        </div>
                        <div class="p-6">
                            <h3 class="text-lg font-bold text-gray-800 mb-2 line-clamp-2">{{ $book->title }}</h3>
                            <p class="text-gray-600 mb-2">by {{ $book->author }}</p>
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs font-medium">{{ $book->category->name }}</span>
                                <span>{{ $book->pages }} pages</span>
                            </div>
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                <span class="{{ $book->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $book->stock > 0 ? 'In Stock (' . $book->stock . ')' : 'Out of Stock' }}
                                </span>
                            </div>
                            
                            <div class="flex gap-2">
                                <a href="{{ route('books.show', $book) }}" 
                                   class="flex-1 bg-gray-100 text-gray-700 px-3 py-2 rounded-lg hover:bg-gray-200 transition text-center font-medium text-sm">
                                    Details
                                </a>
                                @auth
                                    @if($book->stock > 0)
                                        @livewire('add-to-cart', ['bookId' => $book->id])
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            <div class="flex justify-center">
                {{ $books->links() }}
            </div>
        </div>
    </main>
    
    <x-footer />
    @livewireScripts
    
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('show-message', (event) => {
                const data = event.detail || event;
                const messageDiv = document.createElement('div');
                messageDiv.className = `fixed top-4 right-4 px-6 py-4 rounded-lg shadow-lg z-50 flex items-center justify-between ${
                    data.type === 'success' ? 'bg-green-100 border border-green-400 text-green-700' : 'bg-red-100 border border-red-400 text-red-700'
                }`;
                messageDiv.innerHTML = `
                    <span>${data.message}</span>
                    <button onclick="this.parentElement.remove()" class="ml-4 hover:opacity-75">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                `;
                document.body.appendChild(messageDiv);
                
                setTimeout(() => {
                    if (messageDiv.parentElement) {
                        messageDiv.remove();
                    }
                }, 5000);
            });
        });
    </script>
</body>
</html>