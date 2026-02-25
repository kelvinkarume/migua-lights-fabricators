@extends('layouts.public')

@section('content')
<div class="container mt-4">

    {{-- Page Title --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Salary Advance Requests</h4>
    </div>

    {{-- Success Message --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Error Messages --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- Request Advance Form --}}
    <div class="card mb-4">
        <div class="card-header">
            <strong>Request Salary Advance</strong>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('advance.save') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Amount</label>
                    <input
                        type="number"
                        name="amount"
                        class="form-control"
                        placeholder="Enter amount"
                        min="1"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-primary">
                    Submit Request
                </button>
            </form>
        </div>
    </div>

    {{-- Advance History --}}
    <div class="card">
        <div class="card-header">
            <strong>My Advance History</strong>
        </div>
        <div class="card-body p-0">
            @if($advances->isEmpty())
                <div class="p-3">
                    <em>No salary advances found.</em>
                </div>
            @else
                <table class="table table-bordered table-striped mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Amount</th>
                            <th>Status</th>
                            <th>Requested On</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($advances as $advance)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ number_format($advance->amount, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ $advance->status === 'approved' ? 'success' : 'warning' }}">
                                        {{ ucfirst($advance->status ?? 'pending') }}
                                    </span>
                                </td>
                                <td>{{ $advance->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>

</div>
@endsection
