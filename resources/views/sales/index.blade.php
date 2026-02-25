@extends('layouts.public')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-dark text-white">
            Sales Dashboard
        </div>

        <div class="card-body">
            <a href="{{ route('sales.record') }}" class="btn btn-primary">
                Record Sales
            </a>

            <a href="{{ route('sales.reports') }}" class="btn btn-success">
                Sales Reports
            </a>
        </div>
    </div>
</div>
@endsection

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
                        <input type="number" name="quantities_picked[${size.id}]" class="form-control" placeholder="Picked quantity" required>
                        <input type="number" name="quantities_sold[${size.id}]" class="form-control mt-1" placeholder="Sold quantity" required>
                        <input type="number" step="0.01" name="prices[${size.id}]" class="form-control mt-1" placeholder="Price per unit" required>
                    </div>
                `;
            });

            document.getElementById('sizesSection').innerHTML = html;
        });
});
</script>
