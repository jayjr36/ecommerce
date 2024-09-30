@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <!-- Welcome Header Section -->
    <div class="jumbotron text-center bg-light p-4 mb-5 shadow-sm">
        <h1 class="display-4">Welcome, {{ Auth::user()->name }}!</h1>
        <p class="lead">Manage your orders and track your sales easily on ArtisanHub.</p>
        <hr class="my-4">
        <h3>Total Sales: <span class="text-success">${{ number_format($totalSales, 2) }}</span></h3>
    </div>

    <!-- Recent Orders Section -->
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h4>Recent Orders</h4>
        </div>
        <div class="card-body">
            @if($orders->isEmpty())
                <p class="text-muted">No orders found.</p>
            @else
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Delivery Address</th>
                            <th>Items</th>
                            <th>Total Price</th>
                            <th>Order Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                        <tr>
                            <td>{{ $order->id }}</td>
                            <td>{{ $order->name }}</td>
                            <td>{{ $order->delivery_address }}</td>
                            <td>
                                <ul>
                                    @foreach ($order->orderItems as $item)
                                        @if($item->seller_id == Auth::user()->id)
                                            <li>{{ $item->product->name }} (Qty: {{ $item->quantity }})</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </td>
                            <td>${{ number_format($order->total_price, 2) }}</td>
                            <td>{{ $order->created_at->format('d M, Y') }}</td>
                            <td>
                                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <button class="btn btn-sm btn-success" type="submit" {{ $order->status == 'Confirmed' ? 'disabled' : '' }}>Confirm</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>

<!-- Styling for the welcome page -->
<style>
    .jumbotron {
        background-color: #f9f9f9;
        border-radius: 10px;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }

    .card-header {
        background-color: #007bff;
    }

    .lead, .card-body p {
        font-size: 1.25rem;
    }

    .container {
        max-width: 1200px;
    }
</style>
@endsection
