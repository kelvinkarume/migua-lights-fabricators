<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendance;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function index()
    {
        return view('attendance');
    }

    public function loadWeek(Request $request)
    {
        $request->validate([
            'week_start' => 'required|date',
        ]);

        $start = Carbon::parse($request->week_start);
        $days = [];

        for ($i = 0; $i < 7; $i++) {
            $date = $start->copy()->addDays($i)->format('Y-m-d');
            $days[] = [
                'date' => $date,
                'day' => Carbon::parse($date)->format('l'),
                'status' => Attendance::where('user_id', Auth::id())->where('date', $date)->first()?->status,
            ];
        }

        return response()->json($days);
    }
public function save(Request $request)
{
    $request->validate([
        'attendance' => 'required|array',
    ]);

    foreach ($request->attendance as $item) {
        Attendance::updateOrCreate(
            ['user_id' => Auth::id(), 'date' => $item['date']],
            ['status' => $item['status']]
        );
    }

    return redirect()->route('dashboard')->with('success', 'Attendance saved successfully');
}

    
    public function delete($id)
    {
        Attendance::where('id', $id)->where('user_id', Auth::id())->delete();
        return back()->with('success', 'Deleted successfully');
    }

    public function edit($id)
{
    $attendance = Attendance::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    return view('attendance-edit', compact('attendance'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'status' => 'required'
    ]);

    Attendance::where('id', $id)->where('user_id', Auth::id())->update([
        'status' => $request->status
    ]);

    return redirect()->route('dashboard')->with('success', 'Attendance updated successfully');
}

public function summary()
{
    $userId = Auth::id();
    $month = Carbon::now()->format('Y-m');

    $attendances = Attendance::where('user_id', $userId)
        ->where('date', 'like', $month . '%')
        ->orderBy('date', 'asc')
        ->get();

    $presentCount = $attendances->where('status', 'Present')->count();

    return view('attendance-summary', compact('attendances', 'presentCount'));
}


}
 
