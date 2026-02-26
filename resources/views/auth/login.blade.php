@extends('layouts.auth')

@section('content')

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Arial', sans-serif;
        background-color: #0e4219; /* Soft modern background */
    }

    .login-card {
        background-color: #c2c8c9; /* Clean card color */
        border-radius: 15px;
        padding: 40px 30px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .login-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }

    .login-card h3 {
        color: #333;
        margin-bottom: 25px;
        font-weight: 600;
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

    .btn-login {
        background-color: #4A90E2; /* Modern button color */
        color: #fff;
        font-weight: 600;
        border-radius: 10px;
        padding: 12px;
        border: none;
        transition: background-color 0.3s, transform 0.2s;
    }

    .btn-login:hover {
        background-color: #357ABD;
        transform: translateY(-2px);
    }

    .return-link {
        display: block;
        margin-top: 15px;
        text-align: center;
        color: #4A90E2;
        text-decoration: none;
        font-weight: 500;
        transition: 0.3s;
    }

    .return-link:hover {
        color: #235a8f;
    }

    .slideshow {
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        font-weight: 500;
        color: #4A90E2;
        text-align: center;
        margin-bottom: 20px;
    }

    .constant-msg {
        margin-top: 25px;
        text-align: center;
        font-weight: 500;
        color: #34a853; /* Soft green for positive message */
    }
</style>

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-5">

        <!-- Slideshow -->
        <div class="slideshow" id="slideText">
            Migua Fabricators values our employers.
        </div>

        <!-- Login Card -->
        <div class="login-card">
            <h3 class="text-center">Login</h3>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Phone Number</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-login w-100">Login</button>
            </form>

            <!-- Return Link -->
            <a href="{{ route('home') }}" class="return-link">
                ← Return to Home Page
            </a>
        </div>

        <!-- Constant Message -->
        <div class="constant-msg">
            We deliver quality products.
        </div>

    </div>
</div>

<script>
    const slides = [
        "Migua Fabricators values our employers.",
        "Feel free to work efficiently.",
        "Deliver maximumly — your support is our recognition."
    ];

    let index = 0;
    setInterval(() => {
        index = (index + 1) % slides.length;
        document.getElementById('slideText').innerText = slides[index];
    }, 4000);
</script>

@endsection