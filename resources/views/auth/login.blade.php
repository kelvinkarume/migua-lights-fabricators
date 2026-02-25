@extends('layouts.auth')

@section('content')

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: 'Arial', sans-serif;
        overflow-x: hidden;
    }

    .bg-animation {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0;
        left: 0;
        z-index: -1;
        background: linear-gradient(120deg, #ff5f6d, #ffc371, #8E2DE2, #4A00E0);
        background-size: 400% 400%;
        animation: gradient 10s ease infinite;
    }

    @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .glow {
        position: absolute;
        width: 400px;
        height: 400px;
        border-radius: 50%;
        filter: blur(80px);
        opacity: 0.7;
        animation: glow 6s ease infinite;
    }

    @keyframes glow {
        0%, 100% { transform: scale(1); opacity: 0.6; }
        50% { transform: scale(1.2); opacity: 0.9; }
    }

    .glow1 { background: #ff4d6d; top: -120px; left: -120px; }
    .glow2 { background: #2a7cff; top: -120px; right: -120px; }
    .glow3 { background: #00d4ff; bottom: -140px; left: 20%; }

    .login-card {
        background: rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 15px 40px rgba(0,0,0,0.25);
    }

    .slideshow {
        height: 70px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 600;
        text-align: center;
        animation: slide 12s infinite;
    }

    @keyframes slide {
        0%, 33% { opacity: 1; }
        34%, 66% { opacity: 0; }
        67%, 100% { opacity: 1; }
    }

    .constant-msg {
        margin-top: 20px;
        padding: 15px;
        border-radius: 15px;
        background: rgba(0,0,0,0.35);
        text-align: center;
        font-weight: 600;
    }

    .return-link {
        display: block;
        margin-top: 15px;
        text-align: center;
        text-decoration: none;
        font-weight: 600;
        color: #fff;
        transition: 0.3s;
    }

    .return-link:hover {
        color: #ffc371;
        transform: translateY(-2px);
    }
</style>

<div class="bg-animation"></div>
<div class="glow glow1"></div>
<div class="glow glow2"></div>
<div class="glow glow3"></div>

<div class="container vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-6">

        <!-- Slideshow -->
        <div class="slideshow mb-4">
            <span id="slideText" style="color: indigo;">
                Migua Fabricators values our employers.
            </span>
        </div>

        <!-- Login Card -->
        <div class="login-card">
            <h3 class="text-center mb-4" style="color: #333;">Login</h3>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label style="color: #333;">Phone Number</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label style="color: #333;">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <button class="btn btn-light w-100" style="color: #333;">Login</button>
            </form>

            <!-- ✅ RETURN TO LANDING PAGE -->
            <a href="{{ route('home') }}" class="return-link">
                ← Return to Home Page
            </a>
        </div>

        <!-- Constant Message -->
        <div class="constant-msg" style="color: green;">
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