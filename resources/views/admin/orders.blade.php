@extends('layouts.admin')

@section('content')
<div class="container my-4">
    <h2 class="text-center mb-4">Manage Orders</h2>

    @if($orders->count() > 0)
    <div class="table-responsive">
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Order ID</th>
                    <th>User</th>
                    <th>Delivery Address</th>
                    <th>Total Price (Tshs)</th>
                    <th>Items</th>
                    <th>Status</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->name }}</td>
                    <td>{{ $order->delivery_address }}</td>
                    <td>{{ number_format($order->total_price, 2) }}</td>
                    <td>
                        <ul>
                            @foreach(json_decode($order->items, true) as $item)
                            <li>{{ $item['name'] }} ({{ $item['quantity'] }}x)</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <span class="badge {{ $order->status == 'Confirmed' ? 'bg-success' : 'bg-warning' }}">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                    <td>
                        <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button class="btn btn-sm btn-success" type="submit" {{ $order->status == 'Confirmed' ? 'disabled' : '' }}>Confirm</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-info text-center">
        <p>No orders yet.</p>
    </div>
    @endif
</div>
@endsection
