@extends('layouts.customer')

@section('content')
    <div class="container">
        <!-- Filter by category -->
        <form method="GET" action="{{ route('shop') }}">
            <div class="mb-3">
                <div class="row text-center">
                    <div class="col-md-3">
                        <label for="category" class="form-label fs-6" >Filter by Category</label>
                    </div>
                    <div class="col-md-4">
                        <select class="form-control" style="font-size: 12px" name="category" id="category" onchange="this.form.submit()"
                            style=" background-color: #fff3e0;">
                            <option value="{{$categories}}">All Categories</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </form>

        <!-- Products display -->
        <div class="row">
            @foreach ($products as $product)
                <div class="col-md-3">
                    <div class="card mb-3" style="border: 1px; box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.1);">
                        <div class="card-body">
                            <img src="{{ asset('storage/' . $product->image) ?? asset('images/no-image.png') }}"
                                class="card-img-top" alt="{{ $product->name }}"
                                style="max-width: 290px; max-height: 150px; border-radius: 5px;">
                            <h5 class="card-title text-center fs-6">{{ $product->name }}</h5>
                            <p class="card-text" style="font-size: 12px;">
                                 Tsh {{ number_format($product->price, 0) }}
                                @if ($product->quantity > 0)
                                    <span class="badge rounded-pill bg-success mx-5">In Stock</span>
                                @else
                                    <span class="badge rounded-pill bg-danger">Out of Stock</span>
                                @endif
                            </p>

                            @if (auth()->check())
                                <form method="POST" action="{{ route('cart.add') }}">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="quantity" class="form-label" style="font-size: 12px;">Quantity</label>
                                        </div>
                                        <div class="col-md-4" style="font-size: 12px;">
                                            <input type="number" class="form-control" name="quantity" value="1"
                                                min="1" max="{{ $product->quantity }}" required style="font-size: 12px;"
                                                >
                                        </div>
                                    </div>

                                    <div class="row">
                                        <button type="submit" class="btn btn-sm" style="background-color: #ff6600; color: white;">Add to Cart</button>
                               

                                    </div>
                                     </form>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <style>
        body {
            /* background-color: #fff8e1;  */
        }

        .card {
            transition: transform 0.3s;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-primary {
            background-color: #ff6600;
            border-color: #ff6600;
        }

        .btn-primary:hover {
            background-color: #e65c00;
            border-color: #e65c00;
        }
    </style>
@endsection
