@extends('layouts.public')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-dark text-white">
            Edit Production
        </div>

        <div class="card-body">

            <form method="POST" action="{{ route('production.update', $production->id) }}">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Date</label>
                        <input type="date" name="production_date" class="form-control" value="{{ $production->production_date }}" required>
                    </div>

                    <div class="col-md-4">
                        <label>Product Type</label>
                        <select name="product_type_id" id="product_type" class="form-control" required>
                            <option value="">-- Select Type --</option>
                            @foreach($productTypes as $type)
                                <option value="{{ $type->id }}"
                                    {{ $production->product_type_id == $type->id ? 'selected' : '' }}>
                                    {{ ucfirst($type->name) }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label>Product Size</label>
                        <select name="product_size_id" id="product_size" class="form-control" required>
                            <option value="">-- Select Size --</option>
                            @foreach($productSizes as $size)
                                <option value="{{ $size->id }}"
                                    {{ $production->product_size_id == $size->id ? 'selected' : '' }}>
                                    {{ $size->size }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Quantity</label>
                    <input type="number" name="quantity" class="form-control" value="{{ $production->quantity }}" required>
                </div>

                <button class="btn btn-success w-100 mt-3" type="submit">
                    Update Production
                </button>
            </form>

        </div>
    </div>
</div>

<script>
document.getElementById('product_type').addEventListener('change', function() {
    const typeId = this.value;

    fetch(`/production/sizes/load/${typeId}`)
        .then(res => res.json())
        .then(data => {
            let html = '<option value="">-- Select Size --</option>';

            data.forEach(size => {
                html += `<option value="${size.id}">${size.size}</option>`;
            });

            document.getElementById('product_size').innerHTML = html;
        });
});
</script>

@endsection
