@extends('layouts.customer')

@section('content')
<div class="container my-4">
    <h3 class="text-center mb-4">Cart</h3>

    @if (session('cart'))
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach (session('cart') as $id => $details)
                <tr>
                    <td>{{ $details['name'] }}</td>
                    <td>{{ $details['quantity'] }}</td>
                    <td>${{ number_format($details['price'], 2) }}</td>
                    <td>${{ number_format($details['price'] * $details['quantity'], 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-end">
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkoutModal">Proceed to Checkout</button>
    </div>
    @else
    <div class="alert alert-info text-center">
        <p class="text-muted">Your cart is empty.</p>
    </div>
    @endif
</div>

<!-- Checkout Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="checkoutModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="checkoutModalLabel">Checkout</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('cart.checkout') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="delivery_address" class="form-label">Delivery Address</label>
                        <input type="text" class="form-control" name="delivery_address" id="delivery_address" required>
                    </div>
                    @if (Auth::check())
                    <button type="submit" class="btn btn-primary">Proceed to Checkout</button>
                    @else
                    <a href="{{ route('login') }}" class="btn btn-warning">Log in to Checkout</a>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
