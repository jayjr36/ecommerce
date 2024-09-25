<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;


class AdminController extends Controller
{

    public function index()
    {
        // Get total counts
        $totalCustomers = User::where('role', 'customer')->count();
        $totalCategories = Category::count();
        $totalProducts = Product::count();

        return view('admin.dashboard', compact('totalCustomers', 'totalCategories', 'totalProducts'));
    }

    public function orders()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.orders', compact('orders'));
    }

    
    public function updateStatus(Request $request, Order $order)
    {
        $order->update(['status' => 'CONFIRMED']);
        return back()->with('success', 'Order status updated successfully!');
    }
}
