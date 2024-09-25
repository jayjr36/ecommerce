@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Your Cart</h2>

        @if (session('cart'))
            <table class="table">
                <thead>
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
                            <td>${{ $details['price'] }}</td>
                            <td>${{ $details['price'] * $details['quantity'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkoutModal">Proceed to Checkout</button>
        @else
            <p>Your cart is empty.</p>
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
                            <input type="text" class="form-control" name="delivery_address" id="delivery_address"
                                required>
                        </div>
                        @if (Auth::check())
                            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#checkoutModal">Proceed
                                to Checkout</button>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-warning">Log in to Checkout</a>
                        @endif

                        {{-- <button type="submit" class="btn btn-primary">Place Order</button> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
