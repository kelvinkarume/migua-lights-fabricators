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

    
</div>
@endsection
