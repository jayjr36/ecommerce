@extends('layouts.customer')

@section('content')
    <div class="container">
        <h2>Shop</h2>

        <!-- Filter by category -->
        <form method="GET" action="{{ route('shop') }}">
            <div class="mb-3">
                <label for="category" class="form-label">Filter by Category</label>
                <select class="form-control" name="category" id="category" onchange="this.form.submit()">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </form>

        <!-- Products display -->
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3">
                    <div class="card mb-3">
                        <div class="card-body">
                            <img src="{{ asset('storage/' . $product->image) ?? asset('no-image.svg') }}"
                                class="card-img-top" alt="{{ $product->name }}"
                                style="max-width: 290px; max-height: 150px;">
                            <h5 class="card-title text-center">{{ $product->name }}</h5>
                            <p class="card-text">
                                Price: Tsh {{ number_format($product->price, 0) }}
                                @if ($product->quantity > 0)
                                    <span class="badge rounded-pill bg-success">In Stock</span>
                                @else
                                    <span class="badge rounded-pill bg-danger">Out of Stock</span>
                                @endif
                            </p>

                            @if (auth()->check())
                                <form method="POST" action="{{ route('cart.add') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <div class="mb-3">
                                        <label for="quantity" class="form-label">Quantity</label>
                                        <input type="number" class="form-control" name="quantity" value="1"
                                            min="1" max="{{ $product->quantity }}" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Add to Cart</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
