@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-dark text-white">
            Salary Management
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Worker</th>
                        <th>Basic Salary</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach($workers as $worker)
                        <tr>
                            <td>{{ $worker->name }}</td>
                            <td>
                                {{ $worker->salary ? number_format($worker->salary->basic_salary, 2) : 'Not Set' }}
                            </td>
                            <td>
                                @if($worker->salary)
                                    <a href="{{ route('admin.salary.edit', $worker->salary->id) }}" class="btn btn-sm btn-primary">
                                        Edit
                                    </a>
                                @else
                                    <button class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#setSalaryModal{{ $worker->id }}">
                                        Set Salary
                                    </button>
                                @endif
                            </td>
                        </tr>

                        <!-- Set Salary Modal -->
                        <div class="modal fade" id="setSalaryModal{{ $worker->id }}" tabindex="-1">
                            <div class="modal-dialog">
                                <form method="POST" action="{{ route('admin.salary.store') }}">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $worker->id }}">

                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Set Salary for {{ $worker->name }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                        </div>

                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label>Basic Salary</label>
                                                <input type="number" name="basic_salary" class="form-control" required>
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Save</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    @endforeach

                </tbody>
            </table>

        </div>
    </div>
</div>
@endsection
