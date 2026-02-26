namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function create()
    {
        return view('customers.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20|unique:customers,phone',
            'id_number' => 'nullable|string|max:20',
            'area' => 'required|string|max:255',
        ]);

        $customer = Customer::create($request->all());

        // Store customer id in session for order placement
        session(['customer_id' => $customer->id]);

        return redirect()->route('order.create')->with('success', 'Registration successful. Place your order.');
    }
}