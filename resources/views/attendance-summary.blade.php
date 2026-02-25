@extends('layouts.public')

@section('content')
<div class="container">
    <div class="row">

        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Monthly Attendance Summary
                </div>
                <div class="card-body">

                    <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-3">
                        ← Back to Dashboard
                    </a>

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
                                    <td>{{ $att->status }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="alert alert-success">
                        Total Present Days: <strong>{{ $presentCount }}</strong>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
