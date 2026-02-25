@extends('layouts.app')

@section('content')
<h4 class="mb-3">Production Report</h4>

<form method="GET" class="row g-2 mb-3">
    <div class="col-md-3">
        <select name="filter" class="form-control">
            <option value="day">Day</option>
            <option value="week">Week</option>
            <option value="month">Month</option>
            <option value="year">Year</option>
        </select>
    </div>
    <div class="col-md-3">
        <input type="date" name="date" value="{{ $date }}" class="form-control">
    </div>
    <div class="col-md-2">
        <button class="btn btn-primary">Filter</button>
    </div>
</form>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Product Type</th>
            <th>Size</th>
            <th>Total Produced</th>
        </tr>
    </thead>
    <tbody>
        @forelse($perSize as $row)
            <tr>
                <td>{{ $row->type_name }}</td>
                <td>{{ $row->size_name }}</td>
                <td>{{ $row->total_produced }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="3" class="text-center">No results found</td>
            </tr>
        @endforelse
    </tbody>
</table>

<p><strong>Total Metre Box Produced:</strong> {{ $totalMetre }}</p>
<p><strong>Total Adapter Box Produced:</strong> {{ $totalAdapter }}</p>
@endsection
