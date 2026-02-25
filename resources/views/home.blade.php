@extends('layouts.public')

@section('content')
<div class="container mt-5">
    <div class="row align-items-center">
        <div class="col-md-6">
            <h1 class="display-4">Migua Management System</h1>
            <p class="lead">
                Manage your Metre Box & Adapter Box production and sales easily.
            </p>

            <div class="d-flex gap-2 mb-3">
                <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline-light">Signup</a>
            </div>

            
        </div>

        <div class="col-md-6">
            <div id="homeCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="{{ asset('images/metre_box.jpg') }}" class="d-block w-100" alt="Metre Box">
                    </div>
                    <div class="carousel-item">
                        <img src="{{ asset('images/adapter_box.jpg') }}" class="d-block w-100" alt="Adapter Box">
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
