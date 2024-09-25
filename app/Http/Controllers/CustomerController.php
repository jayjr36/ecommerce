<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CustomerController extends Controller
{
    public function myOrders()
{
    $orders = Order::where('user_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
    return view('customer.orders', compact('orders'));
}

}
