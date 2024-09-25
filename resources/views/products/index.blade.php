@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-12">
        <h2>Products</h2>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>${{ $product->price }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>
                            <button class="btn btn-sm btn-warning edit-btn" data-url="{{ route('products.edit', $product->id) }}" data-title="Product">Edit</button>
                            <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
