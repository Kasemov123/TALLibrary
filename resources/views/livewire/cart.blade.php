<div class="max-w-4xl mx-auto px-6 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Shopping Cart</h1>
    
    @if(count($cartItems) > 0)
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            @foreach($cartItems as $item)
                <div class="p-6 border-b border-gray-200 last:border-b-0">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            <div class="w-16 h-20 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                                @if($item->book->image)
                                    <img src="{{ Storage::url($item->book->image) }}" alt="{{ $item->book->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-blue-100 to-indigo-100 flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800">{{ $item->book->title }}</h3>
                                <p class="text-gray-600">by {{ $item->book->author }}</p>
                                <p class="text-sm text-gray-500">{{ $item->book->category->name }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-4">
                            <div class="flex items-center space-x-2">
                                <button wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity - 1 }})" 
                                        class="w-8 h-8 bg-red-100 text-red-600 rounded-full flex items-center justify-center hover:bg-red-200 transition">
                                    -
                                </button>
                                <span class="w-8 text-center font-medium">{{ $item->quantity }}</span>
                                <button wire:click="updateQuantity({{ $item->id }}, {{ $item->quantity + 1 }})" 
                                        class="w-8 h-8 bg-green-100 text-green-600 rounded-full flex items-center justify-center hover:bg-green-200 transition"
                                        {{ $item->quantity >= $item->book->stock ? 'disabled' : '' }}>
                                    +
                                </button>
                            </div>
                            
                            <button wire:click="removeItem({{ $item->id }})" 
                                    class="text-red-600 hover:text-red-800">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
            
            <div class="p-6 bg-gray-50">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-lg font-bold">Total Items: {{ $cartItems->sum('quantity') }}</span>
                </div>
                <button wire:click="checkout" 
                        class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 rounded-lg hover:from-blue-700 hover:to-indigo-700 transition font-medium">
                    Place Order
                </button>
            </div>
        </div>
    @else
        <div class="text-center py-12">
            <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9"/>
            </svg>
            <h2 class="text-2xl font-bold text-gray-600 mb-2">Your cart is empty</h2>
            <p class="text-gray-500 mb-6">Add some books to get started!</p>
            <a href="{{ route('books.index') }}" 
               class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white px-6 py-3 rounded-lg hover:from-blue-700 hover:to-indigo-700 transition font-medium">
                Browse Books
            </a>
        </div>
    @endif
</div>