<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Models\ProductType;
use App\Models\ProductSize;
use Carbon\Carbon;

class SalesController extends Controller
{
    /* =====================================================
        SALES DASHBOARD
    ===================================================== */
    public function index()
    {
        return view('sales.index');
    }

    /* =====================================================
        RECORD SALES PAGE
    ===================================================== */
    public function create()
    {
        $productTypes = ProductType::all();
        $today = now()->format('Y-m-d');

        $salesToday = Sale::with('details.productSize', 'productType')
            ->whereDate('sales_date', $today)
            ->orderBy('sales_date', 'desc')
            ->get();

        return view('sales.record', compact('productTypes', 'salesToday'));
    }

    /* =====================================================
        LOAD SIZES BY PRODUCT TYPE
    ===================================================== */
    public function loadSizes($typeId)
    {
        $sizes = ProductSize::where('product_type_id', $typeId)->get();
        return response()->json($sizes);
    }

    /* =====================================================
        SAVE SALES
    ===================================================== */
    public function store(Request $request)
    {
        $request->validate([
            'sales_date' => 'required|date',
            'product_type_id' => 'required',
            'quantities_picked' => 'required|array',
            'quantities_sold' => 'required|array',
            'prices' => 'required|array',
        ]);

        // -------- CALCULATE TOTALS --------
        $totalPicked = 0;
        $totalSold   = 0;

        foreach ($request->quantities_picked as $sizeId => $pickedQty) {
            $soldQty = (int) ($request->quantities_sold[$sizeId] ?? 0);
            $totalPicked += (int) $pickedQty;
            $totalSold   += $soldQty;
        }

        $totalReturned = max($totalPicked - $totalSold, 0);

        // -------- CREATE SALE HEADER --------
        $sale = Sale::create([
            'user_id'        => Auth::id(),
            'product_type_id'=> $request->product_type_id,
            'sales_date'     => $request->sales_date,
            'day'            => Carbon::parse($request->sales_date)->format('l'),
            'month'          => Carbon::parse($request->sales_date)->format('m'),
            'year'           => Carbon::parse($request->sales_date)->format('Y'),
            'total_picked'   => $totalPicked,
            'total_sold'     => $totalSold,
            'total_returned' => $totalReturned,
        ]);

        // -------- SAVE DETAILS PER SIZE --------
        foreach ($request->quantities_picked as $sizeId => $pickedQty) {
            $soldQty = (int) ($request->quantities_sold[$sizeId] ?? 0);
            $price   = (float) ($request->prices[$sizeId] ?? 0);

            if ($pickedQty <= 0 && $soldQty <= 0) {
                continue;
            }

            SaleDetail::create([
                'sale_id'         => $sale->id,
                'product_size_id' => $sizeId,
                'quantity_picked' => (int) $pickedQty,
                'quantity_sold'   => $soldQty,
                'price_per_size'  => $price,
                'total_amount'    => $soldQty * $price,
            ]);
        }

        return back()->with('success', 'Sales recorded successfully');
    }

    /* =====================================================
        SALES REPORTS
    ===================================================== */
    public function reports(Request $request)
    {
        $productTypes = ProductType::all();
        $query = Sale::query();

        // Filters
        if ($request->date) {
            $query->whereDate('sales_date', $request->date);
        }
        if ($request->week) {
            $query->whereBetween('sales_date', [
                Carbon::parse($request->week)->startOfWeek(),
                Carbon::parse($request->week)->endOfWeek(),
            ]);
        }
        if ($request->month) {
            $month = Carbon::parse($request->month);
            $query->whereMonth('sales_date', $month->month)
                  ->whereYear('sales_date', $month->year);
        }
        if ($request->year) {
            $query->whereYear('sales_date', $request->year);
        }

        $sales = $query->with(['productType', 'details.productSize'])->get();

        // Initialize totals to avoid undefined variable errors
        $totalPerDay   = collect();
        $totalPerWeek  = collect();
        $totalPerMonth = collect();
        $totalPerYear  = collect();

        if ($sales->count()) {
            $totalPerDay = $sales->groupBy('sales_date')->map(function ($items) {
                return $items->sum(fn($sale) => $sale->details->sum('total_amount'));
            });

            $totalPerWeek = $sales->groupBy(fn($sale) => Carbon::parse($sale->sales_date)->startOfWeek()->format('Y-m-d'))
                ->map(fn($items) => $items->sum(fn($sale) => $sale->details->sum('total_amount')));

            $totalPerMonth = $sales->groupBy('month')->map(fn($items) => $items->sum(fn($sale) => $sale->details->sum('total_amount')));
            $totalPerYear  = $sales->groupBy('year')->map(fn($items) => $items->sum(fn($sale) => $sale->details->sum('total_amount')));
        }

        $totalSold = $sales->sum('total_sold');
        $totalReturned = $sales->sum('total_returned');
        $totalSalesAmount = $sales->sum(fn($sale) => $sale->details->sum('total_amount'));

        return view('sales.reports', compact(
            'sales',
            'productTypes',
            'totalSold',
            'totalReturned',
            'totalSalesAmount',
            'totalPerDay',
            'totalPerWeek',
            'totalPerMonth',
            'totalPerYear'
        ));
    }
}