@extends('layouts.public')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header bg-dark text-white">
                    Edit Attendance
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('attendance.update', $attendance->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label>Date</label>
                            <input type="text" class="form-control" value="{{ $attendance->date }}" readonly>
                        </div>

                        <div class="mb-3">
                            <label>Status</label>
                            <select name="status" class="form-control">
                                <option value="present" {{ $attendance->status == 'present' ? 'selected' : '' }}>Present</option>
                                <option value="absent" {{ $attendance->status == 'absent' ? 'selected' : '' }}>Absent</option>
                            </select>
                        </div>

                        <button class="btn btn-dark w-100">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection