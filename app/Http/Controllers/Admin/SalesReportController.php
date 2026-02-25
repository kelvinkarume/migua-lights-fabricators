<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SaleDetail;
use Carbon\Carbon;
use DB;

class SalesReportController extends Controller
{
    public function salesReport(Request $request)
    {
        $filterType = $request->filter ?? 'day';
        $date = $request->date ?? Carbon::now()->toDateString();

        $query = SaleDetail::query();

        // join with sizes and types
        $query->join('product_sizes', 'sale_details.product_size_id', '=', 'product_sizes.id')
              ->join('product_types', 'product_sizes.product_type_id', '=', 'product_types.id');

        // apply filter
        if ($filterType == 'day') {
            $query->whereDate('sale_details.created_at', $date);
        } elseif ($filterType == 'week') {
            $query->whereBetween('sale_details.created_at', [
                Carbon::parse($date)->startOfWeek(),
                Carbon::parse($date)->endOfWeek()
            ]);
        } elseif ($filterType == 'month') {
            $query->whereMonth('sale_details.created_at', Carbon::parse($date)->month)
                  ->whereYear('sale_details.created_at', Carbon::parse($date)->year);
        } elseif ($filterType == 'year') {
            $query->whereYear('sale_details.created_at', Carbon::parse($date)->year);
        }

        // totals per size
        $perSize = (clone $query)->select(
            'product_types.name as type_name',
            'product_sizes.size as size_name',
            DB::raw('SUM(sale_details.quantity_picked) as total_picked'),
            DB::raw('SUM(sale_details.quantity_sold) as total_sold'),
            DB::raw('SUM(sale_details.total_amount) as total_amount')
        )
        ->groupBy('product_types.name', 'product_sizes.size')
        ->get();

        // ====== TOTALS (FIXED) ======
        $totals = (clone $query)->select(
            DB::raw("SUM(CASE WHEN product_types.name = 'metre_box' THEN sale_details.quantity_sold ELSE 0 END) as metre_total_qty"),
            DB::raw("SUM(CASE WHEN product_types.name = 'adapter_box' THEN sale_details.quantity_sold ELSE 0 END) as adapter_total_qty"),
            DB::raw("SUM(CASE WHEN product_types.name = 'metre_box' THEN sale_details.total_amount ELSE 0 END) as metre_total_amount"),
            DB::raw("SUM(CASE WHEN product_types.name = 'adapter_box' THEN sale_details.total_amount ELSE 0 END) as adapter_total_amount")
        )->first();

        return view('admin.reports.sales', [
            'perSize' => $perSize,
            'filterType' => $filterType,
            'date' => $date,
            'totalMetreQty' => $totals->metre_total_qty ?? 0,
            'totalAdapterQty' => $totals->adapter_total_qty ?? 0,
            'totalMetreAmount' => $totals->metre_total_amount ?? 0,
            'totalAdapterAmount' => $totals->adapter_total_amount ?? 0,
        ]);
    }
}
