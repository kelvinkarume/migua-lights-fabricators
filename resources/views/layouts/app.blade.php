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
</head>
<body>

<div class="d-flex">

    <!-- ======= SIDEBAR ======= -->
    <div class="bg-dark text-white p-3" style="width: 250px; min-height: 100vh;">
        <h4 class="text-center">Admin Panel</h4>
        <hr class="bg-white">

        <div class="nav flex-column">

            <a href="{{ route('admin.dashboard') }}"
               class="nav-link text-white {{ request()->routeIs('admin.dashboard') ? 'bg-secondary rounded' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <a href="{{ route('admin.salary.index') }}"
               class="nav-link text-white {{ request()->routeIs('admin.salary.*') ? 'bg-secondary rounded' : '' }}">
                <i class="bi bi-cash-stack"></i> Salary Management
            </a>

            <a href="{{ route('admin.amount.received') }}"
               class="nav-link text-white {{ request()->routeIs('admin.amount.received') ? 'bg-secondary rounded' : '' }}">
                <i class="bi bi-currency-dollar"></i> Amount Received
            </a>

            <a href="{{ route('admin.payroll.index') }}"
               class="nav-link text-white {{ request()->routeIs('admin.payroll.*') ? 'bg-secondary rounded' : '' }}">
                <i class="bi bi-clipboard-check"></i> Payroll Report
            </a>

            <a href="{{ route('admin.production.report') }}" class="{{ request()->routeIs('admin.production.report') ? 'active' : '' }}">
    <i class="bi bi-box-seam"></i> Production Report
</a>

<a href="{{ route('admin.sales.report') }}" class="{{ request()->routeIs('admin.sales.report') ? 'active' : '' }}">
    <i class="bi bi-graph-up-arrow"></i> Sales Report
</a>

        </div>
    </div>
    <!-- ======= END SIDEBAR ======= -->


    <!-- ======= MAIN CONTENT ======= -->
    <div class="flex-grow-1 p-4">
        @yield('content')
    </div>
    <!-- ======= END MAIN CONTENT ======= -->

</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
