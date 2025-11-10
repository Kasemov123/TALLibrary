<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $book->title }} - BookLibrary</title>
    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    <x-navbar />
    <x-flash-message />
    
    <main class="flex-grow py-8">
        <div class="max-w-7xl mx-auto px-6">
            <!-- Book Details -->
            <div class="bg-white rounded-xl shadow-lg overflow-hidden mb-12">
                <div class="grid md:grid-cols-2 gap-8 p-8">
                    <div class="w-96 h-[28rem] mx-auto bg-gray-200 rounded-lg overflow-hidden shadow-lg">
                        @if($book->image)
                            <img src="{{ Storage::url($book->image) }}" alt="{{ $book->title }}" class="w-full h-full object-contain bg-white">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center">
                                <svg class="w-32 h-32 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    
                    <div class="space-y-6">
                        <div>
                            <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $book->title }}</h1>
                            <p class="text-xl text-gray-600 mb-4">by {{ $book->author }}</p>
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-medium">{{ $book->category->name }}</span>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="text-sm text-gray-500">Pages</div>
                                <div class="text-lg font-semibold">{{ $book->pages }}</div>
                            </div>
                            <div class="bg-gray-50 p-4 rounded-lg">
                                <div class="text-sm text-gray-500">Stock</div>
                                <div class="text-lg font-semibold {{ $book->stock > 0 ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $book->stock > 0 ? $book->stock . ' Available' : 'Out of Stock' }}
                                </div>
                            </div>
                        </div>
                        
                        @auth
                            @if($book->stock > 0)
                                <div class="flex gap-4">
                                    @livewire('add-to-cart', ['bookId' => $book->id])
                                </div>
                            @endif
                        @else
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
                                <p class="text-yellow-800">
                                    <a href="{{ route('login') }}" class="font-medium underline">Login</a> to add books to your cart
                                </p>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
            
            <!-- Related Books -->
            @if($relatedBooks->count() > 0)
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Related Books</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($relatedBooks as $relatedBook)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            <div class="w-full h-72 bg-gray-200 rounded-t-xl overflow-hidden">
                                @if($relatedBook->image)
                                    <img src="{{ Storage::url($relatedBook->image) }}" alt="{{ $relatedBook->title }}" class="w-full h-full object-contain bg-white">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center">
                                        <svg class="w-20 h-20 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div class="p-6">
                                <h3 class="text-lg font-bold text-gray-800 mb-2">{{ $relatedBook->title }}</h3>
                                <p class="text-gray-600 mb-4">by {{ $relatedBook->author }}</p>
                                <div class="flex gap-2">
                                    <a href="{{ route('books.show', $relatedBook) }}" 
                                       class="flex-1 bg-gray-100 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-200 transition text-center font-medium">
                                        View Details
                                    </a>
                                    @auth
                                        @if($relatedBook->stock > 0)
                                            @livewire('add-to-cart', ['bookId' => $relatedBook->id])
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif
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