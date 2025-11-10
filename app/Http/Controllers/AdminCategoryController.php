<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{


    public function index()
    {
        $categories = Category::withCount('books')->paginate(10);
        return view('admin.categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.categories.create');
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255|unique:categories']);
        Category::create($request->all());
        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully');
    }

    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|string|max:255|unique:categories,name,' . $category->id]);
        $category->update($request->all());
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully');
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');
    }

    public function trashed()
    {
        $categories = Category::onlyTrashed()->withCount('books')->paginate(10);
        return view('admin.categories.trashed', compact('categories'));
    }

    public function restore($id)
    {
        Category::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin.categories.trashed')->with('success', 'Category restored successfully');
    }

    public function forceDelete($id)
    {
        Category::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('admin.categories.trashed')->with('success', 'Category permanently deleted');
    }
}