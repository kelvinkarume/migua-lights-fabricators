@extends('layouts.public')

@section('content')
<div class="container">
    <h2 class="mb-3">📦 Manage Product Sizes</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-3">
        <label>Select Product Type:</label>
        <select id="product_type" class="form-control">
            <option value="">-- Select Type --</option>
            @foreach($productTypes as $type)
                <option value="{{ $type->id }}">{{ ucfirst($type->name) }}</option>
            @endforeach
        </select>
    </div>

    <div id="sizesSection" style="display:none;">
        <form method="POST" action="{{ route('production.sizes.store') }}">
            @csrf
            <input type="hidden" name="product_type_id" id="selected_type_id">

            <div class="input-group mb-3">
                <input type="text" name="size" class="form-control" placeholder="Enter size (e.g 12x12 or 6*6*6)" required>
                
                <button class="btn btn-success">Add Size</button>
            </div>
        </form>

        <ul class="list-group" id="sizesList">
            <!-- Loaded via AJAX -->
        </ul>
    </div>
</div>

<script>
document.getElementById('product_type').addEventListener('change', function() {
    const typeId = this.value;
    const sizesSection = document.getElementById('sizesSection');
    const sizesList = document.getElementById('sizesList');
    const typeInput = document.getElementById('selected_type_id');

    if (!typeId) {
        sizesSection.style.display = 'none';
        sizesList.innerHTML = '';
        typeInput.value = '';
        return;
    }

    typeInput.value = typeId;
    sizesSection.style.display = 'block';

    fetch(`/production/sizes/load/${typeId}`)
        .then(res => res.json())
        .then(data => {
            let html = '';
            if (data.length === 0) {
                html = '<li class="list-group-item text-muted">No sizes added yet</li>';
            } else {
                data.forEach(size => {
                    html += `
                        <li class="list-group-item d-flex justify-content-between">
                            ${size.size} - KES ${size.price}
                            <a href="/production/sizes/delete/${size.id}" class="btn btn-sm btn-danger"
                               onclick="return confirm('Delete this size?')">Delete</a>
                        </li>`;
                });
            }
            sizesList.innerHTML = html;
        });
});
</script>
@endsection