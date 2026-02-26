<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Check if customer is registered before placing an order
     */
    public function checkCustomer(Request $request)
    {
        // If customer not in session, redirect to register form
        if (!session()->has('customer_name')) {
            return redirect()->route('customer.register');
        }

        // Already registered → redirect to place order
        return redirect()->route('orders.create');
    }

    /**
     * Show registration form
     */
    public function registerForm()
    {
        return view('orders.register');
    }

    /**
     * Save customer registration
     */
    public function register(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'id_number' => 'required|string|max:20',
            'area_of_residence' => 'required|string|max:255',
        ]);

        // Save customer info in session
        session([
            'customer_name' => $request->customer_name,
            'phone_number' => $request->phone_number,
            'id_number' => $request->id_number,
            'area_of_residence' => $request->area_of_residence,
        ]);

        return redirect()->route('orders.create');
    }

    /**
     * Show order page
     */
    public function create()
    {
        // If customer not registered yet
        if (!session()->has('customer_name')) {
            return redirect()->route('customer.register')->with('error', 'Please register first.');
        }

        // Example products — can later be stored in DB or config
        $products = [
            ['name' => 'Metre Box', 'description' => 'Powder-coated durable meter box', 'price' => 3500, 'image' => 'metrebox.jpg'],
            ['name' => 'Adapter Box', 'description' => 'Strong electrical box', 'price' => 2000, 'image' => 'adapterbox.jpg'],
            ['name' => 'Gate Light', 'description' => 'Energy-efficient outdoor light', 'price' => 1200, 'image' => 'gatelight.jpg'],
            ['name' => 'LED Bulbs', 'description' => 'Bright, energy-saving LED bulbs', 'price' => 350, 'image' => 'bulbs.jpg'],
            ['name' => 'Cooker Socket', 'description' => 'Heavy-duty safe socket', 'price' => 950, 'image' => 'cookersocket.jpg'],
            // Add other products here...
        ];

        return view('orders.create', compact('products'));
    }

    /**
     * Store order
     */
    public function store(Request $request)
    {
        $request->validate([
            'products' => 'required|array',
            'products.*.quantity' => 'required|integer|min:1',
        ]);

        if (!session()->has('customer_name')) {
            return redirect()->route('customer.register')->with('error', 'Please register first.');
        }

        $items = [];
        $total_price = 0;

        foreach ($request->products as $product) {
            $quantity = $product['quantity'];
            $price = $product['price'] * $quantity;

            $items[] = [
                'name' => $product['name'],
                'quantity' => $quantity,
                'price' => $product['price'],
            ];

            $total_price += $price;
        }

        // Save order to DB
        $order = Order::create([
            'customer_name' => session('customer_name'),
            'phone_number' => session('phone_number'),
            'id_number' => session('id_number'),
            'area_of_residence' => session('area_of_residence'),
            'products' => json_encode($items),
            'total_price' => $total_price,
            'status' => 'pending',
        ]);

        return redirect()->route('orders.my')->with('success', 'Order placed successfully! Total KES ' . number_format($total_price));
    }

    /**
     * Show customer orders
     */
    public function myOrders()
    {
        if (!session()->has('customer_name')) {
            return redirect()->route('customer.register')->with('error', 'Please register first.');
        }

        $orders = Order::where('customer_name', session('customer_name'))
            ->orderByDesc('created_at')
            ->get();

        return view('orders.my', compact('orders'));
    }

    /**
     * Admin view all orders
     */
    public function adminIndex()
    {
        $orders = Order::orderByDesc('created_at')->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Admin mark order as delivered
     */
    public function approve($id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'delivered';
        $order->save();

        return back()->with('success', 'Order marked as delivered');
    }
}