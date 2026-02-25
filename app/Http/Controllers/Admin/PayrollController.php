<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salary;
use App\Models\SalaryAdvance;
use Carbon\Carbon;

class PayrollController extends Controller
{
    public function index(Request $request)
    {
        // Handle month & year
        if ($request->filled('month')) {
            $date  = Carbon::parse($request->month . '-01');
            $month = $date->month;
            $year  = $date->year;
        } else {
            $month = Carbon::now()->month;
            $year  = Carbon::now()->year;
        }

        // Start and end dates for the month
        $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
        $endDate   = Carbon::createFromDate($year, $month, 1)->endOfMonth();

        // Get all workers with salary
        $salaries = Salary::with('user')->get();

        $payrollData = [];
        $totalSalaryAllWorkers = 0;

        // Loop through workers to calculate final pay
        foreach ($salaries as $salary) {
            $worker = $salary->user;
            if (!$worker) continue;

            $basicSalary = $salary->basic_salary;

            // Sum of approved advances only
            $totalAdvances = SalaryAdvance::where('user_id', $worker->id)
                ->where('status', 'approved')
                ->whereBetween('advance_date', [$startDate, $endDate])
                ->sum('amount');

            // Final Pay = Basic Salary - approved advances
            $finalPay = $basicSalary - $totalAdvances;
            $totalSalaryAllWorkers += $finalPay;

            $payrollData[] = [
                'worker'         => $worker,
                'basic_salary'   => $basicSalary,
                'total_advances' => $totalAdvances,
                'final_pay'      => $finalPay,
            ];
        }

        // Pending advances for admin to approve/reject
        $pendingAdvances = SalaryAdvance::with('user')
            ->where('status', 'pending')
            ->whereBetween('advance_date', [$startDate, $endDate])
            ->get();

        return view('admin.payroll.index', compact(
            'payrollData',
            'totalSalaryAllWorkers',
            'month',
            'year',
            'pendingAdvances'
        ));
    }

    // Approve an advance
    public function approveAdvance($id)
    {
        $advance = SalaryAdvance::findOrFail($id);
        $advance->update(['status' => 'approved']);

        return back()->with('success', "Salary advance for {$advance->user->name} approved.");
    }

    // Reject an advance
    public function rejectAdvance($id)
    {
        $advance = SalaryAdvance::findOrFail($id);
        $advance->update(['status' => 'rejected']);

        return back()->with('success', "Salary advance for {$advance->user->name} rejected.");
    }
}