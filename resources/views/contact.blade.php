@extends('layouts.public')

@section('content')

<style>
.map-container {
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    margin-top: 20px;
}

.map-container iframe {
    width: 100%;
    height: 350px;
    border: 0;
}
</style>

<div class="container mt-4 mb-5">

    <div class="row g-4 justify-content-center">

        <!-- Left: Contact Info Card -->
        <div class="col-md-5">
            <div class="contact-card">
                <h5 class="contact-title">Contact Migua Fabricators</h5>

                <p><i class="bi bi-facebook"></i> Migua Light (Migua Fabricators)</p>

                <p><i class="bi bi-telephone-fill"></i>
                   <a href="tel:0113393877">0113 393 877</a></p>

                <p><i class="bi bi-envelope-fill"></i>
                   <a href="mailto:homelightkeltd@gmail.com">homelightkeltd@gmail.com</a></p>

                <p><i class="bi bi-geo-alt-fill"></i>
                   Utawala – Amani Stage,<br> 
                   Eastern Bypass, Nairobi, Kenya</p>

                <p><i class="bi bi-clock-fill"></i> Always Open</p>
            </div>
        </div>

        <!-- Google Map (Working Version) -->
         <!-- Google Map (Working Version) -->
        <div class="col-md-6">
            <div class="map-container">
                <iframe
                    src="https://maps.google.com/maps?q=Utawala%20Amani%20Stage%20Eastern%20Bypass%20Nairobi&t=&z=15&ie=UTF8&iwloc=&output=embed"
                    allowfullscreen
                    loading="lazy">
                </iframe>
            </div>
        </div>


    </div>
</div>

@endsection