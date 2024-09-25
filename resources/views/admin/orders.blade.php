@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Orders</h2>

    @if($orders->count() > 0)
    <table class="table table-bordered">
        <thead>
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
                <td>{{ $order->total_price }}</td>
                <td>
                    <ul>
                        @foreach(json_decode($order->items, true) as $item)
                        <li>{{ $item['name'] }} ({{ $item['quantity'] }}x)</li>
                        @endforeach
                    </ul>
                </td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                <td>
                    <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button class="btn btn-sm btn-success" type="submit">Confirm</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No orders yet.</p>
    @endif
</div>
@endsection

