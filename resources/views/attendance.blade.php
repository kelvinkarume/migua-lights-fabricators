@extends('layouts.public')
<a href="{{ route('dashboard') }}" class="btn btn-secondary mb-3">
    <i class="bi bi-arrow-left-circle"></i> Back to Dashboard
</a>
@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Mark Attendance for {{ $today }}</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('attendance.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control">
                <option value="present">Present</option>
                <option value="absent">Absent</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit Attendance</button>
    </form>
</div>
@endsection