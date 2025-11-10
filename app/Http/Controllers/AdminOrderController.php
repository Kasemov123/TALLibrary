<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{


    public function index()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load('orderItems.book');
        return view('admin.orders.show', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $request->validate(['status' => 'required|in:pending,processing,completed,cancelled']);
        $order->update(['status' => $request->status]);
        return redirect()->route('admin.orders.index')->with('success', 'Order status updated successfully');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order deleted successfully');
    }

    public function trashed()
    {
        $orders = Order::onlyTrashed()->with('user')->latest()->paginate(10);
        return view('admin.orders.trashed', compact('orders'));
    }

    public function restore($id)
    {
        Order::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin.orders.trashed')->with('success', 'Order restored successfully');
    }

    public function forceDelete($id)
    {
        Order::onlyTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('admin.orders.trashed')->with('success', 'Order permanently deleted');
    }
}