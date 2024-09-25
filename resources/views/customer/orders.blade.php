@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Orders</h2>

    @if($orders->count() > 0)
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order ID</th>
                <th>Delivery Address</th>
                <th>Total Price</th>
                <th>Items</th>
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->delivery_address }}</td>
                <td>${{ $order->total_price }}</td>
                <td>
                    <ul>
                        @foreach(json_decode($order->items, true) as $item)
                        <li>{{ $item['name'] }} ({{ $item['quantity'] }}x)</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>You have not placed any orders yet.</p>
    @endif
</div>
@endsection
