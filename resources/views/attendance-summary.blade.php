@extends('layouts.public')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Monthly Attendance Summary</h3>

    @if($attendances->isEmpty())
        <div class="alert alert-info">No attendance records found.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Day</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendances as $att)
                    <tr>
                        <td>{{ $att->date }}</td>
                        <td>{{ \Carbon\Carbon::parse($att->date)->format('l') }}</td>
                        <td>{{ ucfirst($att->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection