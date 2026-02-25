<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    // Show user dashboard
    public function dashboard()
    {
        return view('dashboard');
    }

    // Show attendance form
    public function attendanceForm()
    {
        $today = now()->toDateString();
        return view('attendance', compact('today'));
    }

    // Store attendance
    public function storeAttendance(Request $request)
    {
        $request->validate([
            'status' => 'required|in:present,absent',
        ]);

        Attendance::updateOrCreate(
            ['user_id' => Auth::id(), 'date' => now()->toDateString()],
            ['status' => $request->status]
        );

        return redirect()->back()->with('success', 'Attendance recorded!');
    }

    // Monthly attendance summary
    public function attendanceSummary()
    {
        $attendances = Attendance::where('user_id', Auth::id())
                                  ->whereMonth('date', now()->month)
                                  ->get();

        return view('attendance-summary', compact('attendances'));
    }

    // Show edit form
    public function editAttendance($id)
    {
        $attendance = Attendance::where('user_id', Auth::id())->findOrFail($id);
        return view('attendance-edit', compact('attendance'));
    }

    // Update attendance
    public function updateAttendance(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:present,absent',
        ]);

        $attendance = Attendance::where('user_id', Auth::id())->findOrFail($id);
        $attendance->status = $request->status;
        $attendance->save();

        return redirect()->route('attendance.summary')->with('success', 'Attendance updated!');
    }

    // Delete attendance
    public function deleteAttendance($id)
    {
        $attendance = Attendance::where('user_id', Auth::id())->findOrFail($id);
        $attendance->delete();

        return redirect()->route('attendance.summary')->with('success', 'Attendance deleted!');
    }
}