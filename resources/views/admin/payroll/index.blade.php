@extends('layouts.app')

@section('content')
<div class="container">

    <div class="card mb-4">
        <div class="card-header bg-dark text-white">
            Monthly Payroll Report
        </div>

        <div class="card-body">

            {{-- ================= FILTER FORM ================= --}}
            <form method="GET" action="{{ route('admin.payroll.index') }}" class="row g-3 mb-4">
                <div class="col-md-4">
                    <label>Month</label>
                    <input type="month" name="month" class="form-control" value="{{ old('month', $month . '-' . str_pad($year, 2, '0', STR_PAD_LEFT)) }}">
                </div>

                <div class="col-md-4">
                    <label>Year</label>
                    <input type="number" name="year" class="form-control" value="{{ $year }}" min="2020" max="{{ date('Y') }}">
                </div>

                <div class="col-md-4 align-self-end">
                    <button class="btn btn-success w-100" type="submit">Filter</button>
                </div>
            </form>

            {{-- ================= PENDING ADVANCES ================= --}}
            @if(isset($pendingAdvances) && $pendingAdvances->count())
                <div class="mb-4">
                    <h5>Pending Salary Advances</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Worker</th>
                                <th>Amount</th>
                                <th>Date Requested</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pendingAdvances as $advance)
                                <tr>
                                    <td>{{ $advance->user->name }}</td>
                                    <td>{{ number_format($advance->amount, 2) }}</td>
                                    <td>{{ \Carbon\Carbon::parse($advance->advance_date)->format('d M, Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.payroll.approve', $advance->id) }}" class="btn btn-sm btn-success" onclick="return confirm('Approve this advance?')">Approve</a>
                                        <a href="{{ route('admin.payroll.reject', $advance->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Reject this advance?')">Reject</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            {{-- ================= PAYROLL TABLE ================= --}}
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Worker</th>
                        <th>Basic Salary</th>
                        <th>Total Approved Advances</th>
                        <th>Final Pay</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payrollData as $data)
                        <tr>
                            <td>{{ $data['worker']->name }}</td>
                            <td>{{ number_format($data['basic_salary'], 2) }}</td>
                            <td>{{ number_format($data['total_advances'], 2) }}</td>
                            <td>{{ number_format($data['final_pay'], 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No results found for selected month/year</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- ================= TOTAL SALARY ================= --}}
            <div class="mt-3">
                <h5>Total Salary for All Workers: {{ number_format($totalSalaryAllWorkers, 2) }}</h5>
            </div>

        </div>
    </div>
</div>
@endsection