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
    $filter = $request->filter ?? 'day';
    $date   = $request->date ?? now()->toDateString();

    $query = DB::table('sale_details')
        ->join('product_sizes', 'sale_details.product_size_id', '=', 'product_sizes.id')
        ->join('product_types', 'product_sizes.product_type_id', '=', 'product_types.id');

    // Apply filter
    if ($filter === 'day') {
        $query->whereDate('sale_details.created_at', $date);
    } elseif ($filter === 'week') {
        $query->whereBetween('sale_details.created_at', [
            Carbon::parse($date)->startOfWeek(),
            Carbon::parse($date)->endOfWeek(),
        ]);
    } elseif ($filter === 'month') {
        $query->whereMonth('sale_details.created_at', Carbon::parse($date)->month)
              ->whereYear('sale_details.created_at', Carbon::parse($date)->year);
    } elseif ($filter === 'year') {
        $query->whereYear('sale_details.created_at', Carbon::parse($date)->year);
    }

    // Total amount received
    $totalAmount = (clone $query)->sum('sale_details.total_amount');

    // Breakdown by type and size
    $amountPerSize = (clone $query)
        ->select(
            'product_types.name as type_name',
            'product_sizes.size as size_name',
            DB::raw('SUM(sale_details.total_amount) as total_amount')
        )
        ->groupBy('product_types.name', 'product_sizes.size')
        ->get();

    // Totals per product type
    $totals = (clone $query)
        ->select(
            DB::raw("SUM(CASE WHEN product_types.name = 'metrebox' THEN sale_details.total_amount ELSE 0 END) as totalMetre"),
            DB::raw("SUM(CASE WHEN product_types.name = 'adapterbox' THEN sale_details.total_amount ELSE 0 END) as totalAdapter")
        )
        ->first();

    $totalMetre = $totals->totalMetre ?? 0;
    $totalAdapter = $totals->totalAdapter ?? 0;

    return view('admin.reports.amount_received', compact(
        'totalAmount',
        'amountPerSize',
        'totalMetre',
        'totalAdapter',
        'filter',
        'date'
    ));
}
}