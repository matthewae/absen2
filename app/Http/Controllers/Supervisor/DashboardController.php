<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\LeaveRequest;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $supervisor = Auth::guard('supervisor')->user();
        $today = now();

        $staffCount = $supervisor->getDepartmentStaffCount();
        $pendingLeaveRequests = $supervisor->getPendingLeaveRequests();

        $recentAssignments = $supervisor->assignments()
            ->with(['staff'])
            ->latest()
            ->take(5)
            ->get();

        $staffAttendanceToday = Staff::with(['attendances' => function($query) use ($today) {
                $query->whereDate('check_in', $today);
                }])
            ->orderBy('name')
            ->get()
            ->map(function($staff) {
                $todayAttendance = $staff->attendances->first();
                $staff->attendance_status = $todayAttendance ? 'present' : 'absent';
                $staff->check_in_time = $todayAttendance ? $todayAttendance->check_in->format('H:i') : null;
                return $staff;
            });

        $staffOnLeave = Staff::whereHas('leaveRequests', function($query) use ($today) {
                $query->where('status', 'approved')
                    ->where('start_date', '<=', $today)
                    ->where('end_date', '>=', $today);
            })
            ->count();

        return view('supervisor.dashboard', compact(
            'supervisor',
            'staffCount',
            'pendingLeaveRequests',
            'recentAssignments',
            'staffAttendanceToday',
            'staffOnLeave'
        ));
    }

    public function viewStaffList()
    {
        $supervisor = Auth::guard('supervisor')->user();
        $staff = Staff::with(['attendances' => function($query) {
                $query->whereDate('check_in', today());
            }])
            ->get();

        return view('supervisor.staff-list', compact('staff'));
    }

    public function viewStaffAttendance(Staff $staff)
    {
        $monthlyAttendance = $staff->attendances()
            ->whereMonth('check_in', now()->month)
            ->whereYear('check_in', now()->year)
            ->get()
            ->groupBy(function($attendance) {
                return $attendance->check_in->format('Y-m-d');
            });

        return view('supervisor.staff-attendance', compact('staff', 'monthlyAttendance'));
    }

    public function viewLeaveRequests()
    {
        $supervisor = Auth::guard('supervisor')->user();
        $leaveRequests = LeaveRequest::whereHas('staff', function($query) use ($supervisor) {
            $query->where('supervisor_id', $supervisor->id);
        })
        ->with(['staff'])
        ->latest()
        ->paginate(10);

        return view('supervisor.leave-requests', compact('supervisor', 'leaveRequests'));
    }

    public function reviewLeaveRequest(LeaveRequest $leaveRequest)
    {
        if ($leaveRequest->staff->supervisor_id !== Auth::guard('supervisor')->id()) {
            abort(403);
        }

        return view('supervisor.review-leave-request', compact('leaveRequest'));
    }

    public function approveLeaveRequest(Request $request, LeaveRequest $leaveRequest)
    {
        if ($leaveRequest->staff->supervisor_id !== Auth::guard('supervisor')->id()) {
            abort(403);
        }

        $request->validate([
            'supervisor_comment' => 'nullable|string'
        ]);

        $leaveRequest->update([
            'status' => 'approved',
            'supervisor_comment' => $request->supervisor_comment,
            'approved_by' => Auth::guard('supervisor')->id(),
            'approved_at' => now()
        ]);

        return redirect()->route('supervisor.leave-requests')
            ->with('success', 'Leave request approved successfully.');
    }

    public function rejectLeaveRequest(Request $request, LeaveRequest $leaveRequest)
    {
        if ($leaveRequest->staff->supervisor_id !== Auth::guard('supervisor')->id()) {
            abort(403);
        }

        $request->validate([
            'supervisor_comment' => 'required|string'
        ]);

        $leaveRequest->update([
            'status' => 'rejected',
            'supervisor_comment' => $request->supervisor_comment,
            'approved_by' => Auth::guard('supervisor')->id(),
            'approved_at' => now()
        ]);

        return redirect()->route('supervisor.leave-requests')
            ->with('success', 'Leave request rejected successfully.');
    }

    public function updateLeaveRequest(Request $request, LeaveRequest $leaveRequest)
    {
        if ($leaveRequest->staff->supervisor_id !== Auth::guard('supervisor')->id()) {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:approved,rejected',
            'comments' => 'nullable|string|max:500'
        ]);

        $leaveRequest->update([
            'status' => $request->status,
            'supervisor_comments' => $request->comments,
            'reviewed_at' => now()
        ]);

        $statusMessage = ucfirst($request->status);
        return redirect()->route('supervisor.leave-requests')
            ->with('success', "Leave request {$statusMessage} successfully.");
    }
}