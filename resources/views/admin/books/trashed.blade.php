<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trashed Books - Admin</title>
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
                <a href="{{ route('admin.books.index') }}" class="block px-6 py-3 text-gray-700 bg-blue-50 border-r-4 border-blue-600">Books</a>
                <a href="{{ route('admin.categories.index') }}" class="block px-6 py-3 text-gray-700 hover:bg-gray-50">Categories</a>
                <a href="{{ route('admin.orders.index') }}" class="block px-6 py-3 text-gray-700 hover:bg-gray-50">Orders</a>
                <a href="{{ route('admin.users.index') }}" class="block px-6 py-3 text-gray-700 hover:bg-gray-50">Users</a>
            </nav>
        </div>
        
        <div class="flex-1 p-8">
            <div class="flex justify-between items-center mb-8">
                <h1 class="text-3xl font-bold text-gray-800">Trashed Books</h1>
                <a href="{{ route('admin.books.index') }}" class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700">Back to Books</a>
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Book</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Author</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Deleted At</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($books as $book)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="w-12 h-16 bg-gray-200 rounded mr-4">
                                            @if($book->image)
                                                <img src="{{ Storage::url($book->image) }}" alt="{{ $book->title }}" class="w-full h-full object-cover rounded">
                                            @endif
                                        </div>
                                        <div class="font-medium">{{ $book->title }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $book->author }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $book->category->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $book->deleted_at->format('M d, Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                    <form method="POST" action="{{ route('admin.books.restore', $book->id) }}" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:text-green-800">Restore</button>
                                    </form>
                                    <form method="POST" action="{{ route('admin.books.forceDelete', $book->id) }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Permanently delete this book?')">Delete Forever</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-8 text-center text-gray-500">No trashed books found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6">{{ $books->links() }}</div>
        </div>
    </div>
</body>
</html>