@extends('layouts.public')

@section('content')
<div class="container">
    <div class="row justify-content-center">

        {{-- Dashboard Card --}}
        <div class="col-md-8">
            <div class="card text-center">
                <div class="card-header bg-dark text-white">
                    Production Manager Dashboard
                </div>

                <div class="card-body">

                    <h4 class="mb-4">Welcome, {{ Auth::user()->name }}</h4>

                    <div class="d-grid gap-3">

                        <a href="{{ route('production.record') }}" class="btn btn-success btn-lg">
                            ➕ Record Production
                        </a>

                        <a href="{{ route('production.sizes') }}" class="btn btn-primary btn-lg">
                            📦 Manage Product Sizes
                        </a>

                        <a href="{{ route('production.daily') }}" class="btn btn-warning btn-lg">
                            📊 View Daily Production
                        </a>

                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@endsection
