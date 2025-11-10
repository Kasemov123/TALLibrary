<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    public function run(): void
    {
        $books = [
            ['title' => 'The Great Gatsby', 'author' => 'F. Scott Fitzgerald', 'pages' => 180, 'stock' => 15, 'category' => 'Fiction'],
            ['title' => 'To Kill a Mockingbird', 'author' => 'Harper Lee', 'pages' => 324, 'stock' => 12, 'category' => 'Fiction'],
            ['title' => '1984', 'author' => 'George Orwell', 'pages' => 328, 'stock' => 20, 'category' => 'Fiction'],
            ['title' => 'Pride and Prejudice', 'author' => 'Jane Austen', 'pages' => 432, 'stock' => 8, 'category' => 'Romance'],
            ['title' => 'The Catcher in the Rye', 'author' => 'J.D. Salinger', 'pages' => 277, 'stock' => 10, 'category' => 'Fiction'],
            ['title' => 'Harry Potter and the Sorcerer\'s Stone', 'author' => 'J.K. Rowling', 'pages' => 309, 'stock' => 25, 'category' => 'Fantasy'],
            ['title' => 'The Lord of the Rings', 'author' => 'J.R.R. Tolkien', 'pages' => 1216, 'stock' => 7, 'category' => 'Fantasy'],
            ['title' => 'The Da Vinci Code', 'author' => 'Dan Brown', 'pages' => 689, 'stock' => 14, 'category' => 'Mystery'],
            ['title' => 'Think and Grow Rich', 'author' => 'Napoleon Hill', 'pages' => 320, 'stock' => 18, 'category' => 'Self-Help'],
            ['title' => 'A Brief History of Time', 'author' => 'Stephen Hawking', 'pages' => 256, 'stock' => 9, 'category' => 'Science'],
            ['title' => 'Steve Jobs', 'author' => 'Walter Isaacson', 'pages' => 656, 'stock' => 11, 'category' => 'Biography'],
            ['title' => 'The Art of War', 'author' => 'Sun Tzu', 'pages' => 273, 'stock' => 16, 'category' => 'History'],
        ];

        foreach ($books as $bookData) {
            $category = Category::where('name', $bookData['category'])->first();
            if ($category) {
                Book::create([
                    'title' => $bookData['title'],
                    'author' => $bookData['author'],
                    'pages' => $bookData['pages'],
                    'stock' => $bookData['stock'],
                    'category_id' => $category->id,
                ]);
            }
        }
    }
}