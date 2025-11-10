<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - BookLibrary</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 flex flex-col min-h-screen">
    <x-navbar />
    
    <main class="flex-grow py-8">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Welcome back, {{ auth()->user()->name }}!</h1>
                <p class="text-gray-600">Manage your orders and explore new books</p>
            </div>
            
            <!-- Quick Actions -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <a href="{{ route('books.index') }}" class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">Browse Books</h3>
                            <p class="text-gray-600 text-sm">Discover new titles</p>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('cart') }}" class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">My Cart</h3>
                            <p class="text-gray-600 text-sm">{{ auth()->user()->cartItems->count() }} items</p>
                        </div>
                    </div>
                </a>
                
                <a href="{{ route('profile') }}" class="bg-white rounded-xl shadow-lg p-6 hover:shadow-xl transition">
                    <div class="flex items-center">
                        <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div>
                            <h3 class="font-bold text-gray-800">Profile</h3>
                            <p class="text-gray-600 text-sm">Update your info</p>
                        </div>
                    </div>
                </a>
            </div>
            
            <!-- Recent Orders -->
            <div class="bg-white rounded-xl shadow-lg">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800">Recent Orders</h2>
                </div>
                <div class="p-6">
                    @php
                        $orders = auth()->user()->orders()->with('orderItems.book')->latest()->take(5)->get();
                    @endphp
                    @if($orders->count() > 0)
                        <div class="space-y-4">
                            @foreach($orders as $order)
                                <div class="border border-gray-200 rounded-lg p-4">
                                    <div class="flex justify-between items-start mb-3">
                                        <div>
                                            <h3 class="font-medium">Order #{{ $order->id }}</h3>
                                            <p class="text-sm text-gray-600">{{ $order->created_at->format('M d, Y') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="font-medium">${{ $order->total_price }}</p>
                                            <span class="px-2 py-1 text-xs rounded-full {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ ucfirst($order->status) }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="space-y-2">
                                        @foreach($order->orderItems as $item)
                                            <div class="flex items-center text-sm text-gray-600">
                                                <span class="w-8 h-8 bg-gray-200 rounded mr-3 flex items-center justify-center text-xs">{{ $item->quantity }}</span>
                                                <span>{{ $item->book->title }}</span>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-8">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M3 3h2l.4 2M7 13h10l4-8H5.4m0 0L7 13m0 0l-1.5 6M7 13l-1.5 6m0 0h9"/>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-600 mb-2">No orders yet</h3>
                            <p class="text-gray-500 mb-4">Start browsing our collection to place your first order!</p>
                            <a href="{{ route('books.index') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 transition">
                                Browse Books
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </main>
    
    <x-footer />
</body>
</html>
