<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminBookController extends Controller
{


    public function index()
    {
        $books = Book::with('category')->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'pages' => 'required|integer|min:1',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('books', 'public');
        }

        Book::create($data);
        return redirect()->route('admin.books.index')->with('success', 'Book added successfully');
    }

    public function edit(Book $book)
    {
        $categories = Category::all();
        return view('admin.books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'pages' => 'required|integer|min:1',
            'stock' => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->all();
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('books', 'public');
        }

        $book->update($data);
        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully');
    }

    public function trashed()
    {
        $books = Book::onlyTrashed()->with('category')->paginate(10);
        return view('admin.books.trashed', compact('books'));
    }

    public function restore($id)
    {
        Book::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin.books.trashed')->with('success', 'Book restored successfully');
    }

    public function forceDelete($id)
    {
        Book::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('admin.books.trashed')->with('success', 'Book permanently deleted');
    }
}