@extends('layouts.public')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">My Orders</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if($orders->isEmpty())
        <p>You have not placed any orders yet.</p>
        <a href="{{ route('orders.create') }}" class="btn btn-primary">Place Your First Order</a>
    @else
        <div class="row">
            @foreach($orders as $order)
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <h5>Order #{{ $order->id }}</h5>
                            <p><strong>Status:</strong> 
                                @if($order->status === 'pending')
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @else
                                    <span class="badge bg-success">Delivered</span>
                                @endif
                            </p>
                            <p><strong>Total:</strong> KES {{ number_format($order->total_price) }}</p>
                            <h6>Products:</h6>
                            <ul>
                                @foreach(json_decode($order->products, true) as $item)
                                    <li>{{ $item['quantity'] }} x {{ $item['name'] }} (KES {{ number_format($item['price']) }})</li>
                                @endforeach
                            </ul>
                            <p><small>Placed on: {{ $order->created_at->format('d M Y, H:i') }}</small></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a href="{{ route('orders.create') }}" class="btn btn-primary mt-3">Place Another Order</a>
    @endif
</div>
@endsection