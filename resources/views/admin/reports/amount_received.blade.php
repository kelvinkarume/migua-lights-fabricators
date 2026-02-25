@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-dark text-white">
            Amount Received Report
        </div>

        <div class="card-body">

            {{-- FILTER --}}
            <form method="GET" action="{{ route('admin.amount.received') }}">
                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Filter</label>
                        <select name="filter" class="form-control">
    <option value="day"   {{ $filter == 'day' ? 'selected' : '' }}>Day</option>
    <option value="week"  {{ $filter == 'week' ? 'selected' : '' }}>Week</option>
    <option value="month" {{ $filter == 'month' ? 'selected' : '' }}>Month</option>
    <option value="year"  {{ $filter == 'year' ? 'selected' : '' }}>Year</option>
</select>
                    </div>
                    <div class="col-md-4">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control">
                    </div>
                    <div class="col-md-4 mt-4">
                        <button class="btn btn-success w-100" type="submit">Filter</button>
                    </div>
                </div>
            </form>

            {{-- TABLE --}}
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Product Type</th>
                            <th>Size</th>
                            <th>Amount Received</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($amountPerSize as $row)
                            <tr>
                                <td>{{ $row->type_name }}</td>
                                <td>{{ $row->size_name }}</td>
                                <td>{{ number_format($row->total_amount, 2) }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">No results found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- TOTALS --}}
            <div class="mt-3">
                <p><strong>TOTAL METRE BOX AMOUNT:</strong> {{ number_format($totalMetre, 2) }}</p>
                <p><strong>TOTAL ADAPTER BOX AMOUNT:</strong> {{ number_format($totalAdapter, 2) }}</p>
            </div>

        </div>
    </div>
</div>
@endsection
