<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Salary;

class SalaryController extends Controller
{
    public function index()
    {
        // Get only users with role = user (workers)
        $workers = User::where('role', 'user')->get();

        // Get salary records
        $salaries = Salary::with('user')->get();

        return view('admin.salary.index', compact('workers', 'salaries'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'basic_salary' => 'required|numeric',
        ]);

        // Create or update salary
        Salary::updateOrCreate(
            ['user_id' => $request->user_id],
            ['basic_salary' => $request->basic_salary]
        );

        return redirect()->back()->with('success', 'Salary saved successfully');
    }

    public function edit($id)
    {
        $salary = Salary::findOrFail($id);
        $workers = User::where('role', 'user')->get();

        return view('admin.salary.edit', compact('salary', 'workers'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'basic_salary' => 'required|numeric',
        ]);

        $salary = Salary::findOrFail($id);
        $salary->update([
            'basic_salary' => $request->basic_salary,
        ]);

        return redirect()->route('admin.salary.index')->with('success', 'Salary updated successfully');
    }
}
