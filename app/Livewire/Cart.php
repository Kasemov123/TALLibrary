<?php

namespace App\Livewire;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Livewire\Component;

class Cart extends Component
{
    public $cartItems = [];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        if (auth()->check()) {
            $this->cartItems = CartItem::with('book')->where('user_id', auth()->id())->get();
        }
    }

    public function removeItem($cartItemId)
    {
        CartItem::find($cartItemId)->delete();
        $this->loadCart();
        $this->dispatch('cart-updated');
    }

    public function updateQuantity($cartItemId, $quantity)
    {
        $cartItem = CartItem::with('book')->find($cartItemId);
        
        if ($quantity > $cartItem->book->stock) {
            session()->flash('error', 'Cannot exceed available stock!');
            return;
        }
        
        if ($quantity > 0) {
            $cartItem->update(['quantity' => $quantity]);
        } else {
            $this->removeItem($cartItemId);
        }
        $this->loadCart();
        $this->dispatch('cart-updated');
    }

    public function checkout()
    {
        if (empty($this->cartItems)) return;

        $total = $this->cartItems->sum(function ($item) {
            return $item->quantity * 10; // سعر ثابت للتبسيط
        });

        $order = Order::create([
            'user_id' => auth()->id(),
            'status' => 'pending',
            'total_price' => $total,
        ]);

        foreach ($this->cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $item->book_id,
                'quantity' => $item->quantity,
                'price' => 10, // سعر ثابت للتبسيط
            ]);
            
            // تقليل المخزون
            $item->book->decrement('stock', $item->quantity);
        }

        CartItem::where('user_id', auth()->id())->delete();
        $this->loadCart();
        
        session()->flash('success', 'Order placed successfully!');
        return redirect()->route('dashboard');
    }

    public function render()
    {
        return view('livewire.cart');
    }
}