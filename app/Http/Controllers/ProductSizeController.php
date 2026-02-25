<?php

namespace App\Http\Controllers;

use App\Models\ProductSize;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductSizeController extends Controller
{
    public function index()
    {
        $productTypes = ProductType::with('sizes')->get();

        return view('production.sizes.index', compact('productTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_type_id' => 'required|exists:product_types,id',
            'size' => 'required|string|max:50',
        ]);

        ProductSize::create([
            'product_type_id' => $request->product_type_id,
            'size' => $request->size,
            'price' => $request->price,
        ]);

        return back()->with('success', 'Size added successfully.');
    }

    public function delete($id)
    {
        ProductSize::findOrFail($id)->delete();

        return back()->with('success', 'Size deleted.');
    }

    public function loadByType($typeId)
{
    $sizes = ProductSize::where('product_type_id', $typeId)->get();
    return response()->json($sizes);
}

}
