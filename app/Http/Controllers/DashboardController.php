<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // Get this month's attendance
        $month = Carbon::now()->format('Y-m');
        $attendances = Attendance::where('user_id', $userId)
            ->where('date', 'like', $month . '%')
            ->orderBy('date', 'asc')
            ->get();

        return view('dashboard', compact('attendances'));
    }
}
