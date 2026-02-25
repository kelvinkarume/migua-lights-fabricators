@extends('layouts.public')

@section('content')
<style>
    body { overflow-x: hidden; }

    .bg-animation {
        position: fixed;
        width: 100%;
        height: 100%;
        top: 0; left: 0;
        z-index: -3;
        background: linear-gradient(120deg, #cfe9d9, #a8d5a2, #7bbf7b);
        background-size: 400% 400%;
        animation: gradient 10s ease infinite;
    }

    @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    .glow {
        position: fixed;
        width: 500px;
        height: 500px;
        border-radius: 50%;
        filter: blur(90px);
        opacity: 0.7;
        animation: glow 7s ease infinite;
        z-index: -2;
    }

    @keyframes glow {
        0%,100% { transform: scale(1); opacity:0.6; }
        50% { transform: scale(1.3); opacity:0.9; }
    }

    .glow1 { background: #cfe9d9; top: -150px; left: -150px; }
    .glow2 { background: #7bbf7b; bottom: -180px; right: -180px; }

    .action-btn {
        display: inline-block;
        padding: 12px 20px;
        margin: 10px 0;
        border-radius: 10px;
        background: linear-gradient(90deg, #ffcc33, #ff8c00);
        color: #000;
        font-weight: bold;
        text-decoration: none;
        box-shadow: 0 6px 12px rgba(0,0,0,0.15);
        transition: transform 0.2s, box-shadow 0.2s;
    }

    .action-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 18px rgba(0,0,0,0.2);
    }

    /* ===== Top-right profile card ===== */
    .top-right-profile {
        position: fixed;
        top: 20px;
        right: 20px;
        width: 200px;
        z-index: 10;
    }

    .top-right-profile img {
        width: 80px;
        height: 80px;
    }

</style>

<div class="bg-animation"></div>
<div class="glow glow1"></div>
<div class="glow glow2"></div>



<div class="container mt-5">
    <div class="row justify-content-center">

        {{-- Main Content --}}
        <div class="col-md-8">
            <div class="card-body text-center">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                <p class="action-btn" style="background: transparent; box-shadow:none; cursor: default;">
                    MIGUA FABRICATORS MANAGEMENT SYSTEM
                </p>

                <div class="d-flex flex-column align-items-center">
                    {{-- Attendance --}}
                    <a href="{{ route('attendance.form') }}" class="action-btn">📅 Mark Attendance</a>

                    {{-- Salary Advance --}}
                    <a href="{{ route('advance.form') }}" class="action-btn">💰 Record Salary Advance</a>

                    {{-- Monthly Attendance Summary --}}
                    <a href="{{ route('attendance.summary') }}" class="action-btn">📊 View Monthly Attendance</a>
                </div>

                <hr>

                {{-- Display Monthly Attendance Summary if $attendances exists --}}
                @if(isset($attendances) && $attendances->count())
                    <h5>Monthly Attendance Summary</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Day</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($attendances as $att)
                                <tr>
                                    <td>{{ $att->date }}</td>
                                    <td>{{ \Carbon\Carbon::parse($att->date)->format('l') }}</td>
                                    <td>{{ ucfirst($att->status) }}</td>
                                    <td>
                                        <a href="{{ route('attendance.edit', $att->id ?? '#') }}" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="{{ route('attendance.delete', $att->id ?? '#') }}" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif

                {{-- Account Settings --}}
                <div class="card mt-3">
                    <div class="card-header bg-secondary text-white">Account Settings</div>
                    <div class="card-body d-flex justify-content-between">
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                           class="btn btn-danger">Logout</a>
                        <a href="{{ route('password.change') }}" class="btn btn-outline-dark">Change Password</a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

<form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>

@endsection