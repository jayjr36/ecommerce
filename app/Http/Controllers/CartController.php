<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\OrderItem;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $cart = session()->get('cart', []);

        $productId = $request->product_id;
        $quantity = $request->quantity;

        // Check if the product is already in the cart
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            // Get product details
            $product = Product::find($productId);
            $cart[$productId] = [
                "name" => $product->name,
                "quantity" => $quantity,
                "price" => $product->price,
                "seller_id" => $product->seller_id,
            ];
        }

        session()->put('cart', $cart);

        return redirect()->back()->with('success', 'Product added to cart!');
    }

    public function checkout(Request $request)
{
    // Redirect to login if user is not authenticated
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Please log in to submit an order.');
    }

    $cart = session()->get('cart', []);

    if (empty($cart)) {
        return redirect()->back()->with('error', 'Your cart is empty.');
    }

    // Save the order
    $order = new Order();
    $order->user_id = auth()->user()->id;
    $order->delivery_address = $request->delivery_address;

    // Calculate total price
    $totalPrice = array_sum(array_map(function ($product) {
        return $product['price'] * $product['quantity'];
    }, $cart));
    
    $order->total_price = $totalPrice;
    $order->save();

    // Save each item in order_items
    foreach ($cart as $productId => $productDetails) {
        $orderItem = new OrderItem();
        $orderItem->order_id = $order->id;
        $orderItem->product_id = $productId;
        $orderItem->seller_id = $productDetails['seller_id']; // Store the seller ID
        $orderItem->quantity = $productDetails['quantity'];
        $orderItem->price = $productDetails['price'] * $productDetails['quantity']; // Save price for this item
        $orderItem->save();
    }

    // Clear the cart after checkout
    session()->forget('cart');

    return redirect()->back()->with('success', 'Order placed successfully!');
}

    // public function checkout(Request $request)
    // {
    //     // Redirect to login if user is not authenticated
    //     if (!Auth::check()) {
    //         return redirect()->route('login')->with('error', 'Please log in to submit an order.');
    //     }
    
    //     $cart = session()->get('cart', []);
    
    //     if (empty($cart)) {
    //         return redirect()->back()->with('error', 'Your cart is empty.');
    //     }
    
    //     // Save the order
    //     $order = new Order();
    //     $order->user_id = auth()->user()->id;
    //     $order->delivery_address = $request->delivery_address;
    //     $order->items = json_encode($cart); // Store the cart as JSON
    //     $order->total_price = array_sum(array_column($cart, 'price')); // Optional: calculate total price
    //     $order->save();
    
    //     // Clear the cart after checkout
    //     session()->forget('cart');
    
    //     return redirect()->back()->with('success', 'Order placed successfully!');
    // }

    public function index()
    {
        // Get the cart items from the session
        $cartItems = Session::get('cart', []);

        return view('cart', compact('cartItems'));
    }

    // Add item to the cart
    // public function add(Request $request)
    // {
    //     $itemId = $request->input('item_id');
    //     $itemQuantity = $request->input('quantity', 1);

    //     // Get the current cart
    //     $cart = Session::get('cart', []);

    //     // Add or update the item in the cart
    //     if (isset($cart[$itemId])) {
    //         $cart[$itemId]['quantity'] += $itemQuantity;
    //     } else {
    //         $cart[$itemId] = [
    //             'quantity' => $itemQuantity,
    //             'name' => $request->input('name'), // Example: item name
    //             'price' => $request->input('price'), // Example: item price
    //         ];
    //     }

    //     // Save the cart back to the session
    //     Session::put('cart', $cart);

    //     return redirect()->route('cart.index')->with('success', 'Item added to cart!');
    // }

    // Remove item from the cart
    public function remove(Request $request)
    {
        $itemId = $request->input('item_id');

        // Get the current cart
        $cart = Session::get('cart', []);

        // Remove the item if it exists
        if (isset($cart[$itemId])) {
            unset($cart[$itemId]);
            Session::put('cart', $cart);
            return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
        }

        return redirect()->route('cart.index')->with('error', 'Item not found in cart!');
    }

    // Clear the cart
    public function clear()
    {
        // Clear the cart from the session
        Session::forget('cart');

        return redirect()->route('cart.index')->with('success', 'Cart cleared!');
    }
}
