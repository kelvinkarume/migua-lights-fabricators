@extends('layouts.public')

@section('content')

<div class="container mt-4">

    {{-- BACK BUTTON AT TOP LEFT --}}
    <div class="mb-3">
        <a href="{{ route('production.dashboard') }}" class="btn btn-outline-dark btn-sm">
            <i class="bi bi-arrow-left-circle"></i> Back to Dashboard
        </a>
    </div>
    
    <div class="card">
        <div class="card-header bg-dark text-white">
            <h5 class="mb-0">Record Production</h5>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('production.store') }}">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Date</label>
                        <input type="date" name="production_date" class="form-control" required>
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

                <div id="sizesSection">
                    <!-- Sizes will load here -->
                </div>

                <button class="btn btn-success w-100 mt-3" type="submit">
                    Save Production
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

    fetch(`/production/sizes/load/${typeId}`)
        .then(res => res.json())
        .then(data => {
            let html = '<hr><h5>Enter Quantities</h5>';

            data.forEach(size => {
                html += `
                    <div class="mb-2">
                        <label>${size.size}</label>
                        <input type="number" name="quantities[${size.id}]" class="form-control" min="0">
                    </div>
                `;
            });

            document.getElementById('sizesSection').innerHTML = html;
        });
});
</script>

@endsection