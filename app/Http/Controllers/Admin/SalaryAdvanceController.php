<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalaryAdvance;

class SalaryAdvanceController extends Controller
{
    public function edit($id)
    {
        $advance = SalaryAdvance::findOrFail($id);
        return view('admin.advance.edit', compact('advance'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $advance = SalaryAdvance::findOrFail($id);
        $advance->update([
            'amount' => $request->amount,
        ]);

        return redirect()->route('admin.payroll.index')
            ->with('success', 'Salary advance updated successfully');
    }
}
