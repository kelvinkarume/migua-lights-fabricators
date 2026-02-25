@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-dark text-white">
            Edit Salary
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.salary.update', $salary->id) }}">
                @csrf

                <div class="mb-3">
                    <label>Worker</label>
                    <input type="text" class="form-control" value="{{ $salary->user->name }}" disabled>
                </div>

                <div class="mb-3">
                    <label>Basic Salary</label>
                    <input type="number" name="basic_salary" class="form-control" value="{{ $salary->basic_salary }}" required>
                </div>

                <button class="btn btn-primary">Update Salary</button>
            </form>
        </div>
    </div>
</div>
@endsection
