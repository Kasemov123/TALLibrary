<?php

namespace App\Livewire;

use App\Models\CartItem;
use Livewire\Component;

class AddToCart extends Component
{
    public $bookId;
    public $quantity = 1;

    public function mount($bookId)
    {
        $this->bookId = $bookId;
    }

    public function addToCart()
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $book = \App\Models\Book::find($this->bookId);
        
        if ($book->stock < 1) {
            $this->dispatch('show-message', message: 'Book is out of stock!', type: 'error');
            return;
        }

        $existingItem = CartItem::where('user_id', auth()->id())
                               ->where('book_id', $this->bookId)
                               ->first();

        if ($existingItem) {
            $this->dispatch('show-message', message: 'Book is already in your cart!', type: 'error');
            return;
        } else {
            CartItem::create([
                'user_id' => auth()->id(),
                'book_id' => $this->bookId,
                'quantity' => $this->quantity,
            ]);
            $this->dispatch('show-message', message: 'Book added to cart!', type: 'success');
        }

        $this->dispatch('cart-updated');
    }

    public function render()
    {
        return view('livewire.add-to-cart');
    }
}