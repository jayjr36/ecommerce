@extends('layouts.customer')

@section('content')
<div class="container my-4">
    <h2 class="text-center mb-4">My Orders</h2>

    @if($orders->count() > 0)
    <div class="table-responsive">
        <table class="table table-hover table-bordered table-stripped">
            <thead class="table-dark">
                <tr>
                    <th>Order ID</th>
                    <th>Delivery Address</th>
                    <th>Total Price(Tshs)</th>
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
                    <td class="text-success">{{ number_format($order->total_price, 2) }}</td>
                    <td>
                        <ul class="list-unstyled">
                            @foreach(json_decode($order->items, true) as $item)
                            <li>{{ $item['name'] }} <span class="badge bg-secondary">{{ $item['quantity'] }}x</span></li>
                            @endforeach
                        </ul>
                    </td>
                    <td>
                        <span class="badge 
                            @if($order->status == 'PENDING') bg-warning 
                            @elseif($order->status == 'COMPLETED') bg-success 
                            @else bg-info @endif">
                            {{ $order->status }}
                        </span>
                    </td>
                    <td>{{ $order->created_at->format('Y-m-d H:i') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="alert alert-info text-center">
        <p>You have not placed any orders yet.</p>
    </div>
    @endif
</div>
@endsection
