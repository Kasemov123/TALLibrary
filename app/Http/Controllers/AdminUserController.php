<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{


    public function index()
    {
        $users = User::withCount('orders')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load('orders.orderItems.book');
        return view('admin.users.show', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate(['is_admin' => 'required|boolean']);
        $user->update(['is_admin' => $request->is_admin]);
        return redirect()->route('admin.users.index')->with('success', 'User updated successfully');
    }
}