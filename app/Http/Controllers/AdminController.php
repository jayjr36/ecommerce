<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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

    public function sellerIndex()
    {

        $sellerId = Auth::user()->id;

        // Fetch all orders that contain products from the seller
        $orders = Order::whereHas('orderItems', function ($query) use ($sellerId) {
            $query->where('seller_id', $sellerId);
        })->with('orderItems')->get();

        // Calculate total sales (sum of all order totals)
        $totalSales = $orders->sum('total_price');

        return view('seller.dashboard', compact('orders', 'totalSales'));

    //     $sellerId = Auth::user()->id;

    //     // Fetch all orders that contain products from the seller
    //     $orders = Order::whereHas('orderItems', function ($query) use ($sellerId) {
    //         $query->where('seller_id', $sellerId);
    //     })->with('orderItems')->get();

    //     // Calculate total sales (sum of all order totals)
    //     $totalSales = $orders->sum('total_price');

    //     return view('seller.dashboard', compact('orders', 'totalSales'));
 
        // Get total counts
        // $totalCategories = Category::count();
        // $order = OrderItem::with('order')->where('seller_id', auth()->user()->id)->get();
        // $totalProducts = Product::where('seller_id', auth()->user()->id)->count();

        // return view('seller.dashboard', compact('totalCategories', 'totalProducts'));
    }

    public function orders()
    {
        $orders = Order::with('user')->orderBy('created_at', 'desc')->get();
        return view('admin.orders', compact('orders'));
    }

    public function sellerOrders()
    {
        $orders = Order::with('items')->orderBy('created_at', 'desc')->get();
        return view('admin.orders', compact('orders'));
    }

    
    public function updateStatus(Request $request, Order $order)
    {
        $order->update(['status' => 'CONFIRMED']);
        return back()->with('success', 'Order status updated successfully!');
    }
}
