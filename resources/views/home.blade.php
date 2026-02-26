@extends('layouts.public')

@section('content')
<style>
    .landing-container {
        min-height: 80vh;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        gap: 30px;
        padding: 50px 15px;
    }

    .landing-logo img {
        max-width: 200px; /* smaller, centered logo */
        height: auto;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
        transition: transform 0.3s;
    }

    .landing-logo img:hover {
        transform: scale(1.05);
    }

    .landing-text h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: #320b8b; /* keep original text color */
    }

    .landing-text p {
        font-size: 1.2rem;
        color: #caa80f; /* keep original text color */
        max-width: 600px;
    }

    @media (max-width: 768px) {
        .landing-logo img {
            max-width: 150px;
        }

        .landing-text h1 {
            font-size: 2rem;
        }

        .landing-text p {
            font-size: 1rem;
        }
    }
</style>

<div class="container landing-container">
    <!-- Logo at the top center -->
    <div class="landing-logo">
        <img src="{{ asset('images/migua_logo.jpg') }}" alt="Migua Logo">
    </div>

    <!-- Text below the logo -->
    <div class="landing-text">
        <h1>Migua Management System</h1>
        <p>
            Manage your Metre Box & Adapter Box production and sales easily.
        </p>
    </div>
</div>
@endsection