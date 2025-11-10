<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Orders - Admin</title>
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
                <a href="{{ route('home') }}" class="block px-6 py-3 text-gray-700 hover:bg-gray-50">Back to Site</a>
                <form method="POST" action="{{ route('logout') }}" class="px-6 py-3">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-800 font-medium w-full text-left">
                        Logout
                    </button>
                </form>
            </nav>
        </div>
        
        <div class="flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Orders</h1>
                <a href="{{ route('admin.orders.trashed') }}" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700">Trashed Orders</a>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Order ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Customer</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($orders as $order)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-medium">#{{ $order->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $order->user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">${{ $order->total_price }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs rounded-full {{ $order->status === 'completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($order->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $order->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="text-blue-600 hover:text-blue-800">View</a>
                                    <form method="POST" action="{{ route('admin.orders.update', $order) }}" class="inline">
                                        @csrf @method('PUT')
                                        <input type="hidden" name="status" value="{{ $order->status === 'pending' ? 'completed' : 'pending' }}">
                                        <button type="submit" class="text-green-600 hover:text-green-800">
                                            {{ $order->status === 'pending' ? 'Complete' : 'Pending' }}
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.orders.destroy', $order) }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6">{{ $orders->links() }}</div>
        </div>
    </div>
</body>
</html>