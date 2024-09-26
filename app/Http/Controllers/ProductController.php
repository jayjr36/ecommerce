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
    
        $imagePath = null; // Initialize an empty image path
    
        // Check if an image is uploaded
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
    
            // Move the image to the 'public/images' directory
            $image->move(public_path('images'), $imageName);
    
            // Save the relative image path (e.g., 'images/imagename.jpg')
            $imagePath = 'images/' . $imageName;
        }
    
        // Create the product with the image path
        Product::create([
            'name' => $request->name,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'category_id' => $request->category_id,
            'image' => $imagePath, // Save the image path to the database
        ]);
    
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
