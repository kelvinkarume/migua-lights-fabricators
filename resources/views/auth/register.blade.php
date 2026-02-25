@extends('layouts.public')

@section('content')
<div class="container" style="min-height: 100vh; background: linear-gradient(120deg, #ff007f, #ff66b2, #ff99cc); background-size: 400% 400%; animation: fadePink 8s ease infinite;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-dark text-white">User Registration</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        {{-- Name --}}
                        <div class="mb-3">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        {{-- National ID --}}
                        <div class="mb-3">
                            <label>National ID</label>
                            <input type="text" name="national_id" class="form-control" required>
                        </div>

                        {{-- Phone --}}
                        <div class="mb-3">
                            <label>Phone Number</label>
                            <input type="text" name="phone" class="form-control" required>
                        </div>

                        {{-- Gender --}}
                        <div class="mb-3">
                            <label>Gender</label>
                            <select name="gender" class="form-control" required>
                                <option value="">-- Select Gender --</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>

                        {{-- Residence --}}
                        <div class="mb-3">
                            <label>Place of Residence</label>
                            <input type="text" name="residence" class="form-control" required>
                        </div>

                        {{-- Photo --}}
                        <div class="mb-3">
                            <label>Profile Photo</label>
                            <input type="file" name="photo" class="form-control">
                        </div>

                        {{-- Password --}}
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        {{-- Confirm Password --}}
                        <div class="mb-3">
                            <label>Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-dark w-100">
                            Register
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@keyframes fadePink {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
</style>
@endsection
