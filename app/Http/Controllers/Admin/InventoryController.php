<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class InventoryController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->filter ?? 'all';
        $dateValue = $request->date_value ?? null; // Optional date input

        $startDate = null;
        $endDate = null;

        // -------- DETERMINE DATE RANGE BASED ON FILTER --------
        if ($filter === 'day' && $dateValue) {
            $startDate = $endDate = Carbon::parse($dateValue);
        } elseif ($filter === 'week' && $dateValue) {
            $startDate = Carbon::parse($dateValue)->startOfWeek();
            $endDate   = Carbon::parse($dateValue)->endOfWeek();
        } elseif ($filter === 'month' && $dateValue) {
            $startDate = Carbon::parse($dateValue)->startOfMonth();
            $endDate   = Carbon::parse($dateValue)->endOfMonth();
        } elseif ($filter === 'year' && $dateValue) {
            $startDate = Carbon::parse($dateValue)->startOfYear();
            $endDate   = Carbon::parse($dateValue)->endOfYear();
        }

        // -------- PRODUCTIONS --------
        $productionsQuery = DB::table('productions');
        if ($startDate && $endDate) {
            $productionsQuery->whereBetween('created_at', [$startDate, $endDate]);
        }
        $productions = $productionsQuery
            ->select('product_type_id', 'product_size_id', DB::raw('SUM(quantity) as total_produced'))
            ->groupBy('product_type_id', 'product_size_id')
            ->get();

        // -------- SALES DETAILS --------
        $salesDetailsQuery = DB::table('sale_details')
            ->join('sales', 'sale_details.sale_id', '=', 'sales.id');

        if ($startDate && $endDate) {
            $salesDetailsQuery->whereBetween('sales.sales_date', [$startDate, $endDate]);
        }

        $salesDetails = $salesDetailsQuery
            ->select(
                'sales.product_type_id',
                'sale_details.product_size_id',
                DB::raw('SUM(sale_details.quantity_picked) as total_picked'),
                DB::raw('SUM(sale_details.quantity_sold) as total_sold'),
                DB::raw('SUM(sale_details.quantity_picked - sale_details.quantity_sold) as total_returned')
            )
            ->groupBy('sales.product_type_id', 'sale_details.product_size_id')
            ->get()
            ->keyBy(function ($item) {
                return $item->product_type_id . '-' . $item->product_size_id;
            });

        // -------- INVENTORY CALCULATION --------
        $inventoryData = [];

        foreach ($productions as $prod) {
            $key = $prod->product_type_id . '-' . $prod->product_size_id;
            $saleData = $salesDetails[$key] ?? null;

            $picked   = $saleData->total_picked ?? 0;
            $sold     = $saleData->total_sold ?? 0;
            $returned = $saleData->total_returned ?? 0;

            // Remaining stock = (Total produced - Total picked) + Total returned
            $remaining = ($prod->total_produced - $picked) + $returned;

            $productName = DB::table('product_types')
                ->where('id', $prod->product_type_id)
                ->value('name');

            $productSize = DB::table('product_sizes')
                ->where('id', $prod->product_size_id)
                ->value('size');

            $inventoryData[] = [
                'product_name' => $productName,
                'size'         => $productSize,
                'produced'     => $prod->total_produced,
                'picked'       => $picked,
                'sold'         => $sold,
                'returned'     => $returned,
                'remaining'    => $remaining,
            ];
        }

        // If no data found, return empty collection (Blade @forelse will handle)
        if (empty($inventoryData)) {
            $inventoryData = collect();
        }

        return view('admin.inventory.index', compact('inventoryData', 'filter'));
    }
}