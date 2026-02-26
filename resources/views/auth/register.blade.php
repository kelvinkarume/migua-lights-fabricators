@extends('layouts.public')

@section('content')

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Arial', sans-serif;
        background-color: #f0f4f8; /* Clean soft background */
    }

    .registration-card {
        background-color: #ffffff;
        border-radius: 15px;
        padding: 40px 30px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .registration-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .registration-card .card-header {
        background-color: #4A90E2; /* Modern header color */
        color: #fff;
        font-weight: 600;
        font-size: 18px;
        border-radius: 10px 10px 0 0;
        text-align: center;
        padding: 15px;
    }

    .form-label {
        color: #555;
        font-weight: 500;
    }

    .form-control {
        border-radius: 10px;
        border: 1px solid #ddd;
        padding: 10px 15px;
        font-size: 16px;
    }

    .btn-register {
        background-color: #4A90E2;
        color: #fff;
        font-weight: 600;
        border-radius: 10px;
        padding: 12px;
        border: none;
        transition: background-color 0.3s, transform 0.2s;
    }

    .btn-register:hover {
        background-color: #357ABD;
        transform: translateY(-2px);
    }
</style>

<div class="container" style="min-height: 100vh; display: flex; justify-content: center; align-items: center;">
    <div class="col-md-6">

        <div class="registration-card card">
            <div class="card-header">User Registration</div>

            <div class="card-body">
                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">National ID</label>
                        <input type="text" name="national_id" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" name="phone" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender</label>
                        <select name="gender" class="form-control" required>
                            <option value="">-- Select Gender --</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Place of Residence</label>
                        <input type="text" name="residence" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Profile Photo</label>
                        <input type="file" name="photo" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-register w-100">Register</button>
                </form>
            </div>
        </div>

    </div>
</div>

@endsection