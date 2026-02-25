<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Migua Fabricators</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            background-color: #f8f9fa; /* Soft light background for dashboard */
        }

        /* Sidebar */
        .sidebar {
            width: 250px;
            min-height: 100vh;
            background: linear-gradient(180deg, #343a40, #495057); /* Dark gradient */
            color: #fff;
        }

        .sidebar h4 {
            padding: 1rem 0;
        }

        .nav-link {
            color: #ced4da;
            padding: 0.75rem 1rem;
            transition: all 0.3s;
        }

        .nav-link i {
            margin-right: 10px;
            font-size: 1.2rem;
        }

        .nav-link:hover {
            background-color: #6c757d;
            color: #fff;
            border-radius: 0.5rem;
        }

        .nav-link.active, .nav-link.bg-secondary {
            background-color: #0d6efd;
            color: #fff !important;
            border-radius: 0.5rem;
        }

        /* Main content */
        .main-content {
            flex-grow: 1;
            padding: 2rem;
        }
    </style>
</head>
<body>

<div class="d-flex">

    <!-- ======= SIDEBAR ======= -->
    <div class="sidebar p-3">
        <h4 class="text-center">Admin Panel</h4>
        <hr class="bg-light">

        <div class="nav flex-column">

            <a href="{{ route('admin.dashboard') }}"
               class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <a href="{{ route('admin.salary.index') }}"
               class="nav-link {{ request()->routeIs('admin.salary.*') ? 'active' : '' }}">
                <i class="bi bi-people-fill"></i> Salary Management
            </a>

            <a href="{{ route('admin.amount.received') }}"
               class="nav-link {{ request()->routeIs('admin.amount.received') ? 'active' : '' }}">
                <i class="bi bi-cash-stack"></i> Amount Received
            </a>

            <a href="{{ route('admin.payroll.index') }}"
               class="nav-link {{ request()->routeIs('admin.payroll.*') ? 'active' : '' }}">
                <i class="bi bi-clipboard-check"></i> Payroll Report
            </a>

            <a href="{{ route('admin.production.report') }}"
               class="nav-link {{ request()->routeIs('admin.production.report') ? 'active' : '' }}">
                <i class="bi bi-box-seam"></i> Production Report
            </a>

            <a href="{{ route('admin.sales.report') }}"
               class="nav-link {{ request()->routeIs('admin.sales.report') ? 'active' : '' }}">
                <i class="bi bi-graph-up-arrow"></i> Sales Report
            </a>

        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
    @csrf
</form>

<a href="#" class="nav-link mt-3" 
   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
   <i class="bi bi-box-arrow-right"></i> Logout
</a>
    </div>
    <!-- ======= END SIDEBAR ======= -->

    <!-- ======= MAIN CONTENT ======= -->
    <div class="main-content">
        @yield('content')
    </div>
    <!-- ======= END MAIN CONTENT ======= -->

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>