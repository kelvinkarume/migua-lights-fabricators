@extends('layouts.public')

@section('content')
<div class="container mt-5">
    <h1 class="display-4">MIGUA Products</h1>
    <p class="lead">Explore our products below.</p>

    <div class="row mt-4">

        <div class="col-md-6">
            <div class="card">
                <img src="{{ asset('images/metre_box.jpg') }}" class="card-img-top" alt="Metre Box">
                <div class="card-body">
                    <h5 class="card-title">Metre Box</h5>
                    <p class="card-text">
                        Metre box is used for ... (you can add your own description)
                    </p>
                    <a href="#" class="btn btn-custom">Learn More</a>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <img src="{{ asset('images/adapter_box.jpg') }}" class="card-img-top" alt="Adapter Box">
                <div class="card-body">
                    <h5 class="card-title">Adapter Box</h5>
                    <p class="card-text">
                        Adapter box is used for ... (you can add your own description)
                    </p>
                    <a href="#" class="btn btn-custom">Learn More</a>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
