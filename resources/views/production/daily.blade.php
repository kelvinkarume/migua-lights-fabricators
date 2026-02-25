@extends('layouts.public')

@section('content')
<div class="container">

    <div class="card mb-4">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <span>Daily Production Records</span>
            <a href="{{ route('production.dashboard') }}" class="btn btn-light btn-sm">
                ← Back to Dashboard
            </a>
        </div>

        <div class="card-body">

            {{-- ================= FILTER SECTION ================= --}}
            <form method="GET" action="{{ route('production.daily') }}" class="mb-4">
                <div class="row g-3">

                    <div class="col-md-3">
                        <label class="form-label">Date (Daily)</label>
                        <input type="date" name="date" class="form-control" value="{{ request('date') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Week Start</label>
                        <input type="date" name="week_start" class="form-control" value="{{ request('week_start') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Week End</label>
                        <input type="date" name="week_end" class="form-control" value="{{ request('week_end') }}">
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Month</label>
                        <select name="month" class="form-control">
                            <option value="">-- Month --</option>
                            @for ($m = 1; $m <= 12; $m++)
                                <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                </option>
                            @endfor
                        </select>
                    </div>

                    <div class="col-md-2">
                        <label class="form-label">Year</label>
                        <input type="number" name="year" class="form-control" value="{{ request('year') }}">
                    </div>

                    <div class="col-md-3">
                        <label class="form-label">Year Only</label>
                        <input type="number" name="year_only" class="form-control" value="{{ request('year_only') }}">
                    </div>

                    <div class="col-md-3 d-flex align-items-end">
                        <button class="btn btn-primary w-100">
                            <i class="bi bi-funnel"></i> Filter
                        </button>
                    </div>

                    <div class="col-md-2 d-flex align-items-end">
                        <a href="{{ route('production.daily') }}" class="btn btn-secondary w-100">
                            Reset
                        </a>
                    </div>

                </div>
            </form>
            {{-- ================= END FILTER ================= --}}

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- ===== NO RESULTS FEEDBACK ===== --}}
            @if($productions->isEmpty())
                <div class="alert alert-warning text-center">
                    No results found for the selected filter.
                </div>
            @else
                <table class="table table-bordered table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th>Manager</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($productions as $prod)
                            <tr>
                                <td>{{ $prod->production_date }}</td>
                                <td>{{ ucfirst($prod->productType->name) }}</td>
                                <td>{{ $prod->productSize->size }}</td>
                                <td>{{ $prod->quantity }}</td>
                                <td>{{ $prod->user->name }}</td>
                                <td>
                                    <a href="{{ route('production.edit', $prod->id) }}" class="btn btn-primary btn-sm">
                                        Edit
                                    </a>
                                    <a href="{{ route('production.delete', $prod->id) }}"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Are you sure you want to delete this record?')">
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif

        </div>
    </div>
</div>
@endsection
