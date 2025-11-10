<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Users - Admin</title>
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
                <a href="{{ route('admin.orders.index') }}" class="block px-6 py-3 text-gray-700 hover:bg-gray-50">Orders</a>
                <a href="{{ route('admin.users.index') }}" class="block px-6 py-3 text-gray-700 bg-blue-50 border-r-4 border-blue-600">Users</a>
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
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Users</h1>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Orders</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Joined</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($users as $user)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $user->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $user->orders_count }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs rounded-full {{ $user->is_admin ? 'bg-purple-100 text-purple-800' : 'bg-gray-100 text-gray-800' }}">
                                        {{ $user->is_admin ? 'Admin' : 'User' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $user->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                    <a href="{{ route('admin.users.show', $user) }}" class="text-blue-600 hover:text-blue-800">View</a>
                                    @if($user->id !== auth()->id())
                                        <form method="POST" action="{{ route('admin.users.update', $user) }}" class="inline">
                                            @csrf @method('PUT')
                                            <input type="hidden" name="is_admin" value="{{ $user->is_admin ? 0 : 1 }}">
                                            <button type="submit" class="text-purple-600 hover:text-purple-800">
                                                {{ $user->is_admin ? 'Remove Admin' : 'Make Admin' }}
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6">{{ $users->links() }}</div>
        </div>
    </div>
</body>
</html>