@extends('layouts.public')

@section('content')
<!-- Floating Go Back Button -->
<a href="{{ url()->previous() }}" 
   style="
       position: fixed;
       top: 20px;
       left: 20px;
       z-index: 1000;
       width: 45px;
       height: 45px;
       background-color: #0d6efd; /* Bootstrap primary color */
       color: white;
       border-radius: 50%;
       display: flex;
       align-items: center;
       justify-content: center;
       box-shadow: 0 2px 6px rgba(0,0,0,0.2);
       text-decoration: none;
       font-size: 20px;
       transition: background-color 0.2s;
   "
   onmouseover="this.style.backgroundColor='#0b5ed7'"
   onmouseout="this.style.backgroundColor='#0d6efd'">
   ←
</a>
<div class="container">
    <div class="card">
        <div class="card-header bg-dark text-white">
            Record Sales
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('sales.store') }}">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Date</label>
                        <input type="date" name="sales_date" class="form-control" required>
                    </div>

                    <div class="col-md-4">
                        <label>Product Type</label>
                        <select name="product_type_id" id="product_type" class="form-control" required>
                            <option value="">-- Select Type --</option>
                            @foreach($productTypes as $type)
                                <option value="{{ $type->id }}">{{ ucfirst($type->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div id="sizesSection"></div>

                <button class="btn btn-success w-100 mt-3" type="submit">
                    Save Sales
                </button>
            </form>

            {{-- ================= TABLE FOR TODAY'S SALES ================= --}}
            @if(isset($salesToday) && $salesToday->count())
            <hr>
            <h5>Today's Sales</h5>
            <table class="table table-bordered table-striped mt-2">
                <thead class="table-dark">
                    <tr>
                        <th>Product Type</th>
                        <th>Size</th>
                        <th>Picked</th>
                        <th>Sold</th>
                        <th>Price</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($salesToday as $sale)
                        @foreach($sale->details as $detail)
                            <tr>
                                <td>{{ $sale->productType->name }}</td>
                                <td>{{ $detail->productSize->size }}</td>
                                <td>{{ $detail->quantity_picked }}</td>
                                <td>{{ $detail->quantity_sold }}</td>
                                <td>{{ number_format($detail->price_per_size, 2) }}</td>
                                <td>{{ number_format($detail->total_amount, 2) }}</td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
            @endif
            {{-- ========================================================== --}}
        </div>
    </div>
</div>

<script>
document.getElementById('product_type').addEventListener('change', function() {
    const typeId = this.value;

    if (!typeId) {
        document.getElementById('sizesSection').innerHTML = '';
        return;
    }

    fetch(`/sales/sizes/load/${typeId}`)
        .then(res => res.json())
        .then(data => {
            let html = '<hr><h5>Enter Picked, Sold & Price</h5>';

            data.forEach(size => {
                html += `
                    <div class="mb-2">
                        <label>${size.size}</label>

                        <input
                            type="number"
                            name="quantities_picked[${size.id}]"
                            class="form-control"
                            placeholder="Picked quantity"
                            value="0"
                            min="0"
                            required
                        >

                        <input
                            type="number"
                            name="quantities_sold[${size.id}]"
                            class="form-control mt-1"
                            placeholder="Sold quantity"
                            required
                        >

                        <input
                            type="number"
                            step="0.01"
                            name="prices[${size.id}]"
                            class="form-control mt-1"
                            placeholder="Price per unit"
                            required
                        >
                    </div>
                `;
            });

            document.getElementById('sizesSection').innerHTML = html;
        });
});
</script>
@endsection