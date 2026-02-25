<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalaryAdvance;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class SalaryAdvanceController extends Controller
{
    public function index()
    {
        $advances = SalaryAdvance::where('user_id', Auth::id())->get();
        return view('advance', compact('advances'));
    }

    public function save(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        SalaryAdvance::create([
            'user_id'      => Auth::id(),
            'amount'       => $request->amount,
            'advance_date' => Carbon::today(),
            'month'        => Carbon::now()->format('F Y'),
            'status'       => 'pending', // ✅ Automatically set new advances to pending
        ]);

        return back()->with('success', 'Salary advance recorded successfully');
    }
}