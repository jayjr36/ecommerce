<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;

class ProductController extends Controller
{
    public function index() {
        $products = Product::with('category')->get();
        return view('products.index', compact('products'));
    }

    public function create() {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }
    public function store(Request $request) {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png'
        ]);

        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $imageName);
        Product::create($request->all());
        return redirect()->route('products.index');
    }

    public function edit(Product $product)
{
    $categories = Category::all();
    return view('products.edit', compact('product', 'categories'));
}


    // public function edit(Product $product) {
    //     $categories = Category::all();
    //     return view('products.edit', compact('product', 'categories'));
    // }

    public function update(Request $request, Product $product) {
        $request->validate([
            'name' => 'required',
            'quantity' => 'required|integer',
            'price' => 'required|numeric',
            'category_id' => 'required',
            'image' => 'nullable|mimes:jpeg,jpg,png'
        ]);

        $image = $request->file('image');
        if ($image) {
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $product->image = $imageName;
        }

        $product->update($request->all());
        return redirect()->route('products.index');
    }

    public function destroy(Product $product) {
        $product->delete();
        return redirect()->route('products.index');
    }

    public function shop(Request $request)
{
    $categories = Category::all();
    $query = Product::query();

    if ($request->has('category')) {
        $query->where('category_id', $request->category);
    }

    $products = $query->get();

    return view('shop', compact('products', 'categories'));
}

}
