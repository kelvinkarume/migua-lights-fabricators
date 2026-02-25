<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Production;
use Carbon\Carbon;
use DB;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->filter ?? 'day';
        $date   = $request->date ?? now()->toDateString();

        $baseQuery = DB::table('productions')
            ->join('product_sizes', 'productions.product_size_id', '=', 'product_sizes.id')
            ->join('product_types', 'product_sizes.product_type_id', '=', 'product_types.id');

        // Apply date filters using production_date
        if ($filter === 'day') {
            $baseQuery->whereDate('productions.production_date', $date);
        } elseif ($filter === 'week') {
            $baseQuery->whereBetween('productions.production_date', [
                Carbon::parse($date)->startOfWeek(),
                Carbon::parse($date)->endOfWeek(),
            ]);
        } elseif ($filter === 'month') {
            $baseQuery->whereMonth('productions.production_date', Carbon::parse($date)->month)
                      ->whereYear('productions.production_date', Carbon::parse($date)->year);
        } elseif ($filter === 'year') {
            $baseQuery->whereYear('productions.production_date', Carbon::parse($date)->year);
        }

        $perSize = (clone $baseQuery)
            ->select(
                'product_types.name as type_name',
                'product_sizes.size as size_name',
                DB::raw('SUM(productions.quantity) as total_produced')
            )
            ->groupBy('product_types.name', 'product_sizes.size')
            ->get();

        $totals = (clone $baseQuery)->select(
            DB::raw("SUM(CASE WHEN product_types.name = 'metre_box' THEN productions.quantity ELSE 0 END) as metre_total"),
            DB::raw("SUM(CASE WHEN product_types.name = 'adapter_box' THEN productions.quantity ELSE 0 END) as adapter_total")
        )->first();

        return view('admin.reports.production', [
            'perSize'      => $perSize,
            'totalMetre'   => $totals->metre_total ?? 0,
            'totalAdapter' => $totals->adapter_total ?? 0,
            'filter'       => $filter,
            'date'         => $date,
        ]);
    }

    public function amountReceived(Request $request)
    {
        // example logic, adjust table & columns to match your DB
        $filter = $request->filter ?? 'day';
        $date   = $request->date ?? now()->toDateString();

        $query = DB::table('payments'); // change to your payments table

        if ($filter === 'day') {
            $query->whereDate('created_at', $date);
        } elseif ($filter === 'week') {
            $query->whereBetween('created_at', [
                Carbon::parse($date)->startOfWeek(),
                Carbon::parse($date)->endOfWeek(),
            ]);
        } elseif ($filter === 'month') {
            $query->whereMonth('created_at', Carbon::parse($date)->month)
                  ->whereYear('created_at', Carbon::parse($date)->year);
        } elseif ($filter === 'year') {
            $query->whereYear('created_at', Carbon::parse($date)->year);
        }

        $totalAmount = $query->sum('amount');

        return view('admin.reports.amount_received', compact('totalAmount', 'filter', 'date'));
    }
}
