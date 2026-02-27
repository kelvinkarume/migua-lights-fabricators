@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header bg-dark text-white">
        <i class="bi bi-boxes"></i> Inventory Summary
    </div>

    <div class="card-body">

        {{-- ================= FILTER FORM ================= --}}
        <form method="GET" action="{{ route('admin.inventory.index') }}" class="row g-3 mb-3">
            <div class="col-md-3">
                <label for="filter">Filter Type</label>
                <select name="filter" id="filter" class="form-control" required>
                    <option value="all" {{ $filter == 'all' ? 'selected' : '' }}>All</option>
                    <option value="day" {{ $filter == 'day' ? 'selected' : '' }}>Day</option>
                    <option value="week" {{ $filter == 'week' ? 'selected' : '' }}>Week</option>
                    <option value="month" {{ $filter == 'month' ? 'selected' : '' }}>Month</option>
                    <option value="year" {{ $filter == 'year' ? 'selected' : '' }}>Year</option>
                </select>
            </div>

            <div class="col-md-3">
                <label for="date_value">Select Date / Month / Year</label>
                <input type="date" name="date_value" id="date_value" class="form-control"
                    value="{{ request('date_value') }}">
            </div>

            <div class="col-md-3 align-self-end">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="{{ route('admin.inventory.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>
        {{-- ================================================== --}}

        {{-- ================= INVENTORY TABLE ================= --}}
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Product</th>
                    <th>Size</th>
                    <th>Total Produced</th>
                    <th>Total Picked</th>
                    <th>Total Sold</th>
                    <th>Total Returned</th>
                    <th>Remaining Stock</th>
                </tr>
            </thead>
            <tbody>
                @forelse($inventoryData as $item)
                    <tr>
                        <td>{{ $item['product_name'] }}</td>
                        <td>{{ $item['size'] }}</td>
                        <td class="text-primary fw-bold">{{ $item['produced'] }}</td>
                        <td>{{ $item['picked'] }}</td>
                        <td class="text-danger">{{ $item['sold'] }}</td>
                        <td class="text-success">{{ $item['returned'] }}</td>
                        <td class="fw-bold {{ $item['remaining'] <= 10 ? 'text-danger' : 'text-success' }}">
                            {{ $item['remaining'] }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-danger fw-bold">
                            No results found for selected period
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        {{-- ================================================== --}}

    </div>
</div>

{{-- ================= FILTER JS ================= --}}
<script>
document.getElementById('filter').addEventListener('change', function () {
    const filter = this.value;
    const dateInput = document.getElementById('date_value');

    // Adjust input type based on filter
    if (filter === 'month') {
        dateInput.type = 'month';
    } else if (filter === 'year') {
        dateInput.type = 'number';
        dateInput.min = 2000;
        dateInput.max = new Date().getFullYear();
    } else {
        dateInput.type = 'date';
    }
});
</script>
@endsection