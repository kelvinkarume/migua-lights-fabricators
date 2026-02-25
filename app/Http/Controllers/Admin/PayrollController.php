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

        // Get workers who have salary set
        $salaries = Salary::with('user')->get();

        $payrollData = [];
        $totalSalaryAllWorkers = 0;

        // Flag to check if there is ANY advance record in that month
        $hasData = SalaryAdvance::whereBetween('advance_date', [$startDate, $endDate])->exists();

        foreach ($salaries as $salary) {

            $worker = $salary->user;

            if (!$worker) {
                continue;
            }

            $basicSalary = $salary->basic_salary;

            // Total advances for this worker in selected month using date range
            $totalAdvances = SalaryAdvance::where('user_id', $worker->id)
                ->whereBetween('advance_date', [$startDate, $endDate])
                ->sum('amount');

            // Final Pay = Basic Salary - Advances
            $finalPay = $basicSalary - $totalAdvances;

            $totalSalaryAllWorkers += $finalPay;

            $payrollData[] = [
                'worker'         => $worker,
                'basic_salary'   => $basicSalary,
                'total_advances' => $totalAdvances,
                'final_pay'      => $finalPay,
            ];
        }

        // If no advance records found for selected month -> show "no results"
        if (!$hasData) {
            $payrollData = [];
            $totalSalaryAllWorkers = 0;
        }

        return view('admin.payroll.index', compact(
            'payrollData',
            'totalSalaryAllWorkers',
            'month',
            'year'
        ));
    }
}
