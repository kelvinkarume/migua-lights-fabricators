@extends('layouts.public')

@section('content')
<div class="container mt-4">
    <h3 class="mb-3">Request Salary Advance</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('advance.save') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="amount">Amount:</label>
            <input type="number" name="amount" id="amount" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-warning">Request Advance</button>
    </form>

    <hr>

    <h5>My Salary Advances</h5>
    @if($advances->isEmpty())
        <p>No advance requests yet.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($advances as $adv)
                    <tr>
                        <td>{{ $adv->amount }}</td>
                        <td>{{ ucfirst($adv->status) }}</td>
                        <td>{{ $adv->created_at->format('Y-m-d') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection