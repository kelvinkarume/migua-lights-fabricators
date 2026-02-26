@extends('layouts.public')

@section('content')
<div class="container py-5" style="max-width: 500px;">
    <h3 class="mb-4 text-center">Customer Registration</h3>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('customer.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="customer_name" class="form-label">Full Name</label>
            <input type="text" name="customer_name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="text" name="phone_number" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="id_number" class="form-label">ID Number</label>
            <input type="text" name="id_number" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="area_of_residence" class="form-label">Area of Residence</label>
            <input type="text" name="area_of_residence" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Register & Continue</button>
    </form>
</div>
@endsection