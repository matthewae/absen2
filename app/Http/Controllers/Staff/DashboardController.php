<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Attendance;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $staff = Auth::guard('staff')->user();
        $today = now();

        $latestAttendance = $staff->latestAttendance;
        $monthlyAttendance = $staff->attendances()
            ->whereMonth('check_in', $today->month)
            ->whereYear('check_in', $today->year)
            ->get();

        $upcomingAssignments = $staff->assignments()
            ->where('start_datetime', '>', $today)
            ->orderBy('start_datetime')
            ->take(5)
            ->get();

        $pendingLeaveRequests = $staff->leaveRequests()
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        $leaveRequests = $staff->leaveRequests()
            ->latest()
            ->take(5)
            ->get();

        return view('staff.dashboard', compact(
            'staff',
            'latestAttendance',
            'monthlyAttendance',
            'upcomingAssignments',
            'pendingLeaveRequests',
            'leaveRequests'
        ));
    }

    public function checkIn(Request $request)
    {
        $staff = Auth::guard('staff')->user();
        $now = now();

        // Check if already checked in today
        $existingAttendance = $staff->attendances()
            ->whereDate('check_in', $now->toDateString())
            ->first();

        if ($existingAttendance) {
            return back()->with('error', 'You have already checked in today.');
        }

        // Create new attendance record
        $attendance = $staff->attendances()->create([
            'check_in' => $now,
            'status' => $now->hour > 9 ? 'late' : 'present',
            'location' => $request->location
        ]);

        return back()->with('success', 'Successfully checked in.');
    }

    public function submitWorkProgress(Request $request)
    {
        $request->validate([
            'work_progress' => 'required|string'
        ]);

        $staff = Auth::guard('staff')->user();
        $today = now()->toDateString();

        $attendance = $staff->attendances()
            ->whereDate('check_in', $today)
            ->first();

        if (!$attendance) {
            return back()->with('error', 'No attendance record found for today.');
        }

        $attendance->update([
            'work_progress' => $request->work_progress,
            'is_work_submitted' => true
        ]);

        return back()->with('success', 'Work progress submitted successfully.');
    }

    public function checkOut(Request $request)
    {
        $staff = Auth::guard('staff')->user();
        $today = now()->toDateString();

        $attendance = $staff->attendances()
            ->whereDate('check_in', $today)
            ->first();

        if (!$attendance) {
            return back()->with('error', 'No attendance record found for today.');
        }

        if (!$attendance->is_work_submitted) {
            return back()->with('error', 'Please submit your work progress before checking out.');
        }

        if ($attendance->check_out) {
            return back()->with('error', 'You have already checked out today.');
        }

        $attendance->update([
            'check_out' => now()
        ]);

        return back()->with('success', 'Successfully checked out.');
    }
}