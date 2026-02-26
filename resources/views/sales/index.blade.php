@extends('layouts.public')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header bg-dark text-white">
            Sales Dashboard
        </div>

        <div class="card-body">
            <a href="{{ route('sales.record') }}" class="btn btn-primary">
                Record Sales
            </a>

            <a href="{{ route('sales.reports') }}" class="btn btn-success">
                Sales Reports
            </a>

            {{-- Logout Button --}}
            <div class="mt-4">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger">
                         Logout
                    </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection