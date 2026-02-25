@extends('layouts.public')

@section('content')
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

                        <!-- FIXED: picked quantity default value -->
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
