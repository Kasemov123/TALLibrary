<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->paginate(10);
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(StoreBookRequest $request)
    {
        Book::create($request->validated());

        return redirect()->route('admin.books.index')
                         ->with('success', 'Book created successfully.');
    }

    public function edit(Book $book)
    {
        return view('admin.books.edit', compact('book'));
    }

    public function update(UpdateBookRequest $request, Book $book)
    {
        $book->update($request->validated());

        return redirect()->route('admin.books.index')
                         ->with('success', 'Book updated successfully.');
    }

    /**
     * Soft Delete
     */
    public function destroy(Book $book)
    {
        $book->delete(); 
        return redirect()->route('admin.books.index')
                         ->with('success', 'Book soft deleted successfully.');
    }

    /**
     * عرض الكتب المحذوفة (trashed)
     */
    public function trashed()
    {
        $books = Book::onlyTrashed()->paginate(10);
        return view('admin.books.trashed', compact('books'));
    }

    /**
     * استرجاع كتاب محذوف
     */
    public function restore($id)
    {
        $book = Book::onlyTrashed()->findOrFail($id);
        $book->restore();

        return redirect()->route('admin.books.trashed')
                         ->with('success', 'Book restored successfully.');
    }

    /**
     * حذف مؤبد (force delete)
     */
    public function forceDelete($id)
    {
        $book = Book::onlyTrashed()->findOrFail($id);
        $book->forceDelete();

        return redirect()->route('admin.books.trashed')
                         ->with('success', 'Book permanently deleted.');
    }
}
