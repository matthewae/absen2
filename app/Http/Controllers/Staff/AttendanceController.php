<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\WorkProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function checkin(Request $request)
    {
        $staff = Auth::guard('staff')->user();
        
        // Check if staff has already checked in today
        $existingAttendance = Attendance::where('staff_id', $staff->id)
            ->whereDate('check_in', now()->setTimezone('Asia/Jakarta')->toDateString())
            ->first();
            
        if ($existingAttendance) {
            return redirect()->back()->with('error', 'You have already checked in today.');
        }
        
        // Set timezone to WIB and determine attendance status based on check-in time
        $now = now()->setTimezone('Asia/Jakarta');
        $startTime = $now->copy()->setHour(9)->setMinute(0)->setSecond(0); // 9:00 AM WIB
        $lateTime = $now->copy()->setHour(9)->setMinute(30)->setSecond(0); // 9:30 AM WIB
        
        $status = 'present';
        if ($now > $lateTime) {
            $status = 'late';
        }

        // Create new attendance record
        Attendance::create([
            'staff_id' => $staff->id,
            'check_in' => $now,
            'status' => $status,
        ]);
        
        return redirect()->back()->with('success', 'Check-in successful.');
    }
    
    public function checkout(Request $request)
    {
        $staff = Auth::guard('staff')->user();
        
        // Find today's attendance record
        $attendance = Attendance::where('staff_id', $staff->id)
            ->whereDate('check_in', today())
            ->whereNull('check_out')
            ->first();
            
        if (!$attendance) {
            return redirect()->back()->with('error', 'No check-in record found for today.');
        }

        // Check if staff has submitted work progress for today
        $hasWorkProgress = WorkProgress::where('staff_id', $staff->id)
            ->whereDate('created_at', today())
            ->exists();

        if (!$hasWorkProgress) {
            return redirect()->back()->with('error', 'Please submit your work progress for today before checking out.');
        }
        
        // Update checkout time with WIB timezone
        $attendance->update([
            'check_out' => now()->setTimezone('Asia/Jakarta'),
            'status' => $attendance->status // Maintain the current status
        ]);
        
        return redirect()->back()->with('success', 'Check-out successful.');
    }
    
    public function index()
    {
        $staff = Auth::guard('staff')->user();
        
        // Get today's attendance
        $latestAttendance = Attendance::where('staff_id', $staff->id)
            ->whereDate('check_in', today())
            ->first();
        
        // Get monthly attendance records
        $monthlyAttendance = Attendance::where('staff_id', $staff->id)
            ->whereMonth('check_in', now()->month)
            ->whereYear('check_in', now()->year)
            ->orderBy('check_in', 'desc')
            ->get();

        // Get paginated attendance history
        $attendanceHistory = Attendance::where('staff_id', $staff->id)
            ->orderBy('check_in', 'desc')
            ->paginate(10);
        
        return view('staff.attendance', [
            'latestAttendance' => $latestAttendance,
            'monthlyAttendance' => $monthlyAttendance,
            'attendanceHistory' => $attendanceHistory,
            'staff' => $staff
        ]);
    }
}