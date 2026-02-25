<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductType;
use App\Models\ProductSize;
use App\Models\Production;

class ProductionController extends Controller
{
    // Dashboard
    public function dashboard()
    {
        return view('production.dashboard');
    }

    // Record production form
    public function create()
    {
        $productTypes = ProductType::all();
        return view('production.record', compact('productTypes'));
    }

    // Store production
    public function store(Request $request)
    {
        $request->validate([
            'production_date' => 'required|date',
            'product_type_id' => 'required|exists:product_types,id',
            'quantities' => 'required|array',
        ]);

        foreach ($request->quantities as $sizeId => $qty) {
            if ($qty == null || $qty == 0) continue;

            Production::create([
                'user_id' => Auth::id(),
                'product_type_id' => $request->product_type_id,
                'product_size_id' => $sizeId,
                'quantity' => $qty,
                'production_date' => $request->production_date,
                'month' => date('m', strtotime($request->production_date)),
                'year' => date('Y', strtotime($request->production_date)),
            ]);
        }

        return redirect()->route('production.dashboard')
            ->with('success', 'Production recorded successfully');
    }

    // View daily production
    public function daily(Request $request)
{
    $query = Production::with(['user', 'productType', 'productSize'])
        ->orderBy('production_date', 'desc');

    /* =========================
        FILTER LOGIC
    ========================= */

    // Daily filter (specific date)
    if ($request->filled('date')) {
        $query->whereDate('production_date', $request->date);
    }

    // Weekly filter
    if ($request->filled('week_start') && $request->filled('week_end')) {
        $query->whereBetween('production_date', [
            $request->week_start,
            $request->week_end
        ]);
    }

    // Monthly filter
    if ($request->filled('month') && $request->filled('year')) {
        $query->whereMonth('production_date', $request->month)
              ->whereYear('production_date', $request->year);
    }

    // Yearly filter
    if ($request->filled('year_only')) {
        $query->whereYear('production_date', $request->year_only);
    }

    $productions = $query->get();

    return view('production.daily', compact('productions'));
}

    // Edit production
    public function edit($id)
    {
        $production = Production::findOrFail($id);
        $productTypes = ProductType::all();
        $productSizes = ProductSize::where('product_type_id', $production->product_type_id)->get();

        return view('production.edit', compact('production', 'productTypes', 'productSizes'));
    }

    // Update production
    public function update(Request $request, $id)
    {
        $request->validate([
            'production_date' => 'required|date',
            'product_type_id' => 'required|exists:product_types,id',
            'product_size_id' => 'required|exists:product_sizes,id',
            'quantity' => 'required|numeric|min:1',
        ]);

        $production = Production::findOrFail($id);

        $production->update([
            'product_type_id' => $request->product_type_id,
            'product_size_id' => $request->product_size_id,
            'quantity' => $request->quantity,
            'production_date' => $request->production_date,
            'month' => date('m', strtotime($request->production_date)),
            'year' => date('Y', strtotime($request->production_date)),
        ]);

        return redirect()->route('production.daily')
            ->with('success', 'Production updated successfully');
    }

    // Delete production
    public function delete($id)
    {
        Production::findOrFail($id)->delete();

        return redirect()->route('production.daily')
            ->with('success', 'Production deleted successfully');
    }
}
