@extends('layouts.public')

@section('content')
<a href="{{ route('home') }}" class="btn btn-outline-primary floating-back-btn">
    <i class="bi bi-arrow-left-circle"></i> Back to Home
</a>

<!-- AOS Animation CSS -->
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">

<style>
    body {
        background: linear-gradient(to right, #f8fbff, #eef3f9);
    }

    .section-title {
        font-weight: 700;
        letter-spacing: 1px;
        color: #0d6efd;
    }

    .product-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: all 0.4s ease;
        box-shadow: 0 8px 25px rgba(0,0,0,0.06);
        background: #ffffff;
    }

    .product-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 35px rgba(13,110,253,0.15);
    }

    .product-img {
        height: 160px;
        object-fit: cover;
    }

    .price-tag {
        font-weight: bold;
        color: #198754;
        font-size: 16px;
    }

    .order-btn {
        border-radius: 50px;
        padding: 6px 18px;
        font-size: 14px;
        transition: 0.3s ease;
    }

    .order-btn:hover {
        transform: scale(1.05);
    }

    .premium-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .premium-header p {
        color: #555;
        max-width: 600px;
        margin: auto;
    }
    .floating-back-btn {
    position: fixed;
    top: 20px;
    left: 20px;
    z-index: 9999;
    border-radius: 30px;
    padding: 8px 18px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.15);
    transition: 0.3s ease;
}

.floating-back-btn:hover {
    transform: translateY(-2px);
}
</style>


    <div class="premium-header" data-aos="fade-down">
        <h2 class="section-title">Our Premium Products</h2>
        <p>
            Migua Fabricators delivers high-quality electrical and hardware products
            designed for durability, safety, and long-term performance.
        </p>
    </div>

    <div class="row g-4">

        {{-- EXISTING PRODUCTS (UNCHANGED) --}}
        <!-- Metre Box -->
        <div class="col-md-3" data-aos="fade-up">
            <div class="card product-card">
                <img src="{{ asset('images/metrebox.jpg') }}" class="card-img-top product-img">
                <div class="card-body text-center">
                    <h6>Metre Box</h6>
                    <p class="small">Powder-coated durable meter box for safety.</p>
                    <div class="price-tag mb-2">KES 3,500</div>
                    <a href="#" class="btn btn-primary order-btn">Order Now</a>
                </div>
            </div>
        </div>

        <!-- Adapter Box -->
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
            <div class="card product-card">
                <img src="{{ asset('images/adapterbox.jpg') }}" class="card-img-top product-img">
                <div class="card-body text-center">
                    <h6>Adapter Box</h6>
                    <p class="small">Strong and reliable electrical distribution box.</p>
                    <div class="price-tag mb-2">KES 2,000</div>
                    <a href="#" class="btn btn-primary order-btn">Order Now</a>
                </div>
            </div>
        </div>

        <!-- Gate Lights -->
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
            <div class="card product-card">
                <img src="{{ asset('images/gatelight.jpg') }}" class="card-img-top product-img">
                <div class="card-body text-center">
                    <h6>Gate Lights</h6>
                    <p class="small">Energy-efficient outdoor lighting solution.</p>
                    <div class="price-tag mb-2">KES 1,200</div>
                    <a href="#" class="btn btn-primary order-btn">Order Now</a>
                </div>
            </div>
        </div>

        <!-- Bulbs -->
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
            <div class="card product-card">
                <img src="{{ asset('images/bulbs.jpg') }}" class="card-img-top product-img">
                <div class="card-body text-center">
                    <h6>LED Bulbs</h6>
                    <p class="small">Bright, energy-saving LED lighting.</p>
                    <div class="price-tag mb-2">KES 350</div>
                    <a href="#" class="btn btn-primary order-btn">Order Now</a>
                </div>
            </div>
        </div>

        <!-- Cooker Socket -->
        <div class="col-md-3" data-aos="fade-up">
            <div class="card product-card">
                <img src="{{ asset('images/cookersocket.jpg') }}" class="card-img-top product-img">
                <div class="card-body text-center">
                    <h6>Cooker Socket</h6>
                    <p class="small">Heavy-duty safe power connection socket.</p>
                    <div class="price-tag mb-2">KES 950</div>
                    <a href="#" class="btn btn-primary order-btn">Order Now</a>
                </div>
            </div>
        </div>

        <!-- Tangit -->
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
            <div class="card product-card">
                <img src="{{ asset('images/tangit.jpg') }}" class="card-img-top product-img">
                <div class="card-body text-center">
                    <h6>Tangit</h6>
                    <p class="small">Strong adhesive for plumbing installations.</p>
                    <div class="price-tag mb-2">KES 600</div>
                    <a href="#" class="btn btn-primary order-btn">Order Now</a>
                </div>
            </div>
        </div>

        <!-- Full Moon -->
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
            <div class="card product-card">
                <img src="{{ asset('images/fullmoon.jpg') }}" class="card-img-top product-img">
                <div class="card-body text-center">
                    <h6>Full Moon Light</h6>
                    <p class="small">Stylish modern ceiling illumination.</p>
                    <div class="price-tag mb-2">KES 1,800</div>
                    <a href="#" class="btn btn-primary order-btn">Order Now</a>
                </div>
            </div>
        </div>

        <!-- Solar -->
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
            <div class="card product-card">
                <img src="{{ asset('images/solar.jpg') }}" class="card-img-top product-img">
                <div class="card-body text-center">
                    <h6>Solar Lighting</h6>
                    <p class="small">Eco-friendly solar lighting systems.</p>
                    <div class="price-tag mb-2">KES 4,500</div>
                    <a href="#" class="btn btn-primary order-btn">Order Now</a>
                </div>
            </div>
        </div>

        {{-- NEW PRODUCTS ADDED BELOW --}}

        <!-- Solar Floodlights -->
        <div class="col-md-3" data-aos="fade-up">
            <div class="card product-card">
                <img src="{{ asset('images/solarflood.jpg') }}" class="card-img-top product-img">
                <div class="card-body text-center">
                    <h6>Solar Floodlights</h6>
                    <p class="small">High-power outdoor solar floodlights for security and compound lighting.</p>
                    <div class="price-tag mb-2">KES 6,500</div>
                    <a href="#" class="btn btn-primary order-btn">Order Now</a>
                </div>
            </div>
        </div>

        <!-- Half Moon -->
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
            <div class="card product-card">
                <img src="{{ asset('images/halfmoon.jpg') }}" class="card-img-top product-img">
                <div class="card-body text-center">
                    <h6>Half Moon Light</h6>
                    <p class="small">Modern half-moon wall lighting for stylish indoor decor.</p>
                    <div class="price-tag mb-2">KES 1,500</div>
                    <a href="#" class="btn btn-primary order-btn">Order Now</a>
                </div>
            </div>
        </div>

        <!-- Single Pendant -->
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
            <div class="card product-card">
                <img src="{{ asset('images/singlependant.jpg') }}" class="card-img-top product-img">
                <div class="card-body text-center">
                    <h6>Single Pendant Light</h6>
                    <p class="small">Elegant hanging light ideal for dining and kitchen areas.</p>
                    <div class="price-tag mb-2">KES 2,800</div>
                    <a href="#" class="btn btn-primary order-btn">Order Now</a>
                </div>
            </div>
        </div>

        <!-- Chandelier -->
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
            <div class="card product-card">
                <img src="{{ asset('images/chandelier.jpg') }}" class="card-img-top product-img">
                <div class="card-body text-center">
                    <h6>Chandelier Lighting</h6>
                    <p class="small">Luxury chandelier lighting for living rooms and halls.</p>
                    <div class="price-tag mb-2">KES 12,000</div>
                    <a href="#" class="btn btn-primary order-btn">Order Now</a>
                </div>
            </div>
        </div>

        <!-- Trunking -->
        <div class="col-md-3" data-aos="fade-up">
            <div class="card product-card">
                <img src="{{ asset('images/trunking.jpg') }}" class="card-img-top product-img">
                <div class="card-body text-center">
                    <h6>Trunking</h6>
                    <p class="small">Durable cable trunking for neat and secure wiring installations.</p>
                    <div class="price-tag mb-2">KES 750</div>
                    <a href="#" class="btn btn-primary order-btn">Order Now</a>
                </div>
            </div>
        </div>

        <!-- Wall Bracket -->
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
            <div class="card product-card">
                <img src="{{ asset('images/wallbracket.jpg') }}" class="card-img-top product-img">
                <div class="card-body text-center">
                    <h6>Wall Bracket</h6>
                    <p class="small">Strong wall mounting brackets for lights and fixtures.</p>
                    <div class="price-tag mb-2">KES 900</div>
                    <a href="#" class="btn btn-primary order-btn">Order Now</a>
                </div>
            </div>
        </div>

        <!-- Pendant -->
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
            <div class="card product-card">
                <img src="{{ asset('images/pendant.jpg') }}" class="card-img-top product-img">
                <div class="card-body text-center">
                    <h6>Pendant Lighting</h6>
                    <p class="small">Modern decorative pendant lighting for stylish interiors.</p>
                    <div class="price-tag mb-2">KES 3,500</div>
                    <a href="#" class="btn btn-primary order-btn">Order Now</a>
                </div>
            </div>
        </div>

        <!-- CCTV Camera -->
        <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
            <div class="card product-card">
                <img src="{{ asset('images/cctv.jpg') }}" class="card-img-top product-img">
                <div class="card-body text-center">
                    <h6>CCTV Camera</h6>
                    <p class="small">High-definition security surveillance cameras for homes and businesses.</p>
                    <div class="price-tag mb-2">KES 5,500</div>
                    <a href="#" class="btn btn-primary order-btn">Order Now</a>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true
    });
</script>

@endsection