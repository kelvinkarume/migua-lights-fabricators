@extends('layouts.app')

@section('content')
<div class="container mt-4">

    {{-- Migua Logo Card --}}
    <div class="card mb-4 shadow-sm">
        <div class="card-body d-flex align-items-center">
            <img src="{{ asset('images/migua_logo.jpg') }}" alt="Migua Logo" style="height:60px; margin-right:20px;">
            <div>
                <h4 class="mb-0">Migua Fabricators</h4>
                <small class="text-muted">Quality Products | Accurate Inventory | Excellence in Service</small>
            </div>
        </div>
    </div>

    {{-- Dashboard Card --}}
    <div class="card shadow">
        <div class="card-header text-white" style="background-color: #28a745;">
            <h3 class="mb-0">Admin Dashboard</h3>
        </div>
        <div class="card-body">
            <p class="lead">
                Welcome back, Admin! Here you can monitor inventory, track production, manage sales,
                and ensure everything runs smoothly at Migua Fabricators. Keep up the great work!
            </p>
        </div>
    </div>

    {{-- Footer (Simple Text Only) --}}
    <div class="text-center mt-4">
        <p class="mb-0 text-success fw-semibold">
            © {{ date('Y') }} Migua Fabricators. All rights reserved.
        </p>
    </div>

</div>
@endsection