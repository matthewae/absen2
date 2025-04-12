<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use App\Models\Staff;
use Illuminate\Http\Request;

class LeaveRequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:supervisor');
    }

    public function index(Request $request)
    {
        $status = $request->query('status', 'all');
        
        // Query all leave requests
        $query = LeaveRequest::with(['staff', 'approvedBy'])
            ->whereHas('staff')
            ->latest();
            
        // Filter by status if specified
        if ($status !== 'all') {
            $query->where('status', $status);
        }
        
        $leaveRequests = $query->paginate(10);
        
        return view('supervisor.leave-requests', compact('leaveRequests'));
    }

    public function update(Request $request, LeaveRequest $leaveRequest)
    {
        $supervisor = auth('supervisor')->user();
        if (!$supervisor) {
            abort(401, 'Please login first.');
        }

        // Only check if the leave request belongs to a valid staff
        if (!$leaveRequest->staff_id) {
            abort(404, 'Staff not found for this leave request.');
        }

        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
            'supervisor_comment' => 'nullable|string'
        ]);

        $leaveRequest->update([
            'status' => $validated['status'],
            'supervisor_comment' => $validated['supervisor_comment'] ?? null,
            'approved_by' => $supervisor->id,
            'approved_at' => now()
        ]);

        return redirect()->back()->with('success', 'Leave request has been ' . $validated['status'] . '.');
    }
}