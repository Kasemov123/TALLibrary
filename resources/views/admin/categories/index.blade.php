<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Categories - Admin</title>
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
                <a href="{{ route('admin.categories.index') }}" class="block px-6 py-3 text-gray-700 bg-blue-50 border-r-4 border-blue-600">Categories</a>
                <a href="{{ route('admin.orders.index') }}" class="block px-6 py-3 text-gray-700 hover:bg-gray-50">Orders</a>
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
                <h1 class="text-3xl font-bold text-gray-800">Categories</h1>
                <div class="flex gap-4">
                    <a href="{{ route('admin.categories.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">Add Category</a>
                    <a href="{{ route('admin.categories.trashed') }}" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700">Trashed Categories</a>
                </div>
            </div>
            
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Books Count</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Created</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($categories as $category)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $category->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $category->books_count }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $category->created_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                    <a href="{{ route('admin.categories.edit', $category) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                                    <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6">{{ $categories->links() }}</div>
        </div>
    </div>
</body>
</html>