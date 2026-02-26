@extends('layouts.public')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">Place Your Order</h2>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('orders.store') }}" method="POST">
        @csrf

        <div class="row">
            @foreach($products as $index => $product)
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <img src="{{ asset('images/'.$product['image']) }}" class="card-img-top" alt="{{ $product['name'] }}">
                        <div class="card-body text-center">
                            <h5 class="card-title">{{ $product['name'] }}</h5>
                            <p class="card-text">{{ $product['description'] }}</p>
                            <p><strong>KES {{ number_format($product['price']) }}</strong></p>

                            <input type="hidden" name="products[{{ $index }}][name]" value="{{ $product['name'] }}">
                            <input type="hidden" name="products[{{ $index }}][price]" value="{{ $product['price'] }}">
                            <div class="form-group">
                                <label>Quantity:</label>
                                <input type="number" name="products[{{ $index }}][quantity]" value="1" min="0" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-success mt-3">Place Order</button>
    </form>
</div>
@endsection