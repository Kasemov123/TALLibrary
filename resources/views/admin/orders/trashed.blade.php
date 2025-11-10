<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trashed Orders - Admin</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50">
    <div class="min-h-screen flex">
        <div class="w-64 bg-white shadow-lg">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-gray-800">Admin Panel</h2>
            </div>
            <nav class="mt-6">
                <a href="{{ route('admin.dashboard') }}" class="block px-6 py-3 text-gray-700 hover:bg-gray-50">Dashboard</a>
                <a href="{{ route('admin.books.index') }}" class="block px-6 py-3 text-gray-700 hover:bg-gray-50">Books</a>
                <a href="{{ route('admin.categories.index') }}" class="block px-6 py-3 text-gray-700 hover:bg-gray-50">Categories</a>
                <a href="{{ route('admin.orders.index') }}" class="block px-6 py-3 text-gray-700 bg-blue-50 border-r-4 border-blue-600">Orders</a>
                <a href="{{ route('admin.users.index') }}" class="block px-6 py-3 text-gray-700 hover:bg-gray-50">Users</a>
            </nav>
        </div>
        
        <div class="flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Trashed Orders</h1>
                <a href="{{ route('admin.orders.index') }}" class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700">Back to Orders</a>
            </div>
            
            @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @endif
            
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deleted At</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($orders as $order)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-medium">#{{ $order->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $order->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">${{ $order->total_price }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs rounded-full {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $order->deleted_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                    <form method="POST" action="{{ route('admin.orders.restore', $order->id) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-800">Restore</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.orders.forceDelete', $order->id) }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Permanently delete this order?')">Delete Forever</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-8 text-center text-gray-500">No trashed orders found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6">{{ $orders->links() }}</div>
        </div>
    </div>
</body>
</html>