@extends('layouts.public')

@section('content')
<!-- Floating Go Back Button -->
<a href="{{ url()->previous() }}" 
   style="
       position: fixed;
       top: 20px;
       left: 20px;
       z-index: 1000;
       width: 45px;
       height: 45px;
       background-color: #0d6efd; /* Bootstrap primary color */
       color: white;
       border-radius: 50%;
       display: flex;
       align-items: center;
       justify-content: center;
       box-shadow: 0 2px 6px rgba(0,0,0,0.2);
       text-decoration: none;
       font-size: 20px;
       transition: background-color 0.2s;
   "
   onmouseover="this.style.backgroundColor='#0b5ed7'"
   onmouseout="this.style.backgroundColor='#0d6efd'">
   ←
</a>
<div class="container">
    <div class="card">
        <div class="card-header bg-dark text-white">
            Sales Reports
        </div>

        <div class="card-body">

            <form method="GET" action="{{ route('sales.reports') }}">
                <div class="row">
                    <div class="col-md-3">
                        <label>Date</label>
                        <input type="date" name="date" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label>Week (Pick a date)</label>
                        <input type="date" name="week" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label>Month</label>
                        <input type="month" name="month" class="form-control">
                    </div>

                    <div class="col-md-3">
                        <label>Year</label>
                        <input type="number" name="year" class="form-control" placeholder="e.g 2025">
                    </div>
                </div>

                <button class="btn btn-primary mt-3" type="submit">Filter</button>
            </form>

            <hr>

            @if($sales->isEmpty())
                <div class="alert alert-warning">
                    No results found.
                </div>
            @else

                <div class="alert alert-info">
                    <b>Total Sales Amount:</b> KES {{ number_format($totalSalesAmount, 2) }}
                </div>

                <hr>

                <h5>Sales Report</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Type</th>
                            <th>Size</th>
                            <th>Sold</th>
                            <th>Total Amount</th>
                            <th>Returned</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sales as $sale)
                            @foreach($sale->details as $detail)
                                <tr>
                                    <td>{{ $sale->sales_date }}</td>
                                    <td>{{ $sale->productType->name }}</td>
                                    <td>{{ $detail->productSize->size }}</td>
                                    <td>{{ $detail->quantity_sold }}</td>
                                    <td>KES {{ number_format($detail->total_amount, 2) }}</td>
                                    <td>{{ ($detail->quantity_picked - $detail->quantity_sold) }}</td>

                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>

                <hr>

                <h5>Total Per Day</h5>
                <ul>
                    @foreach($totalPerDay as $date => $amount)
                        <li>{{ $date }} → KES {{ number_format($amount, 2) }}</li>
                    @endforeach
                </ul>

                <h5>Total Per Week</h5>
                <ul>
                    @foreach($totalPerWeek as $weekStart => $amount)
                        <li>Week starting {{ $weekStart }} → KES {{ number_format($amount, 2) }}</li>
                    @endforeach
                </ul>

                <h5>Total Per Month</h5>
                <ul>
                    @foreach($totalPerMonth as $month => $amount)
                        <li>{{ $month }} → KES {{ number_format($amount, 2) }}</li>
                    @endforeach
                </ul>

                <h5>Total Per Year</h5>
                <ul>
                    @foreach($totalPerYear as $year => $amount)
                        <li>{{ $year }} → KES {{ number_format($amount, 2) }}</li>
                    @endforeach
                </ul>

            @endif

        </div>
    </div>
</div>
@endsection
