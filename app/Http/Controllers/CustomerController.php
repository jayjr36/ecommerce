<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function myOrders()
{
    // $orders = Order::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
    
    $buyerId = Auth::user()->id;
    $orders = Order::where('user_id', $buyerId)
    ->with('orderItems.product') // Load related order items and product details
    ->orderBy('created_at', 'desc')
    ->get();

    return view('customer.orders', compact('orders'));
}

}
