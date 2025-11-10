<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Books - Admin</title>
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
                <h1 class="text-3xl font-bold text-gray-800">Books</h1>
                <div class="flex gap-4">
                    <a href="{{ route('admin.books.create') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">Add Book</a>
                    <a href="{{ route('admin.books.trashed') }}" class="bg-red-600 text-white px-6 py-3 rounded-lg hover:bg-red-700">Trashed Books</a>
                </div>
            </div>
            
            @if(session('success'))
                <div id="admin-flash" class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4 flex justify-between items-center">
                    <span>{{ session('success') }}</span>
                    <button onclick="document.getElementById('admin-flash').remove()" class="text-green-700 hover:text-green-900">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/>
                        </svg>
                    </button>
                </div>
                <script>
                    setTimeout(() => {
                        const msg = document.getElementById('admin-flash');
                        if (msg) msg.remove();
                    }, 5000);
                </script>
            @endif
            
            <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Book</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Author</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Category</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stock</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @foreach($books as $book)
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
                                <td class="px-6 py-4 whitespace-nowrap text-gray-600">{{ $book->stock }}</td>
                                <td class="px-6 py-4 whitespace-nowrap space-x-2">
                                    <a href="{{ route('admin.books.edit', $book) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                                    <form method="POST" action="{{ route('admin.books.destroy', $book) }}" class="inline">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-6">{{ $books->links() }}</div>
        </div>
    </div>
</body>
</html>