<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class LeaveRequestController extends Controller
{
    public function index()
    {
        $staff = Auth::guard('staff')->user();
        $leaveRequests = $staff->leaveRequests()
            ->with('approvedBy')
            ->latest()
            ->paginate(10);

        return view('staff.leave-requests.index', compact('leaveRequests'));
    }

    public function create()
    {
        return view('staff.leave-requests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'reason' => 'required|string',
            'attachment' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:2048'
        ]);

        $staff = Auth::guard('staff')->user();
        $leaveRequest = new LeaveRequest($request->only(['type', 'start_date', 'end_date', 'reason']));

        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('leave-requests', 'public');
            $leaveRequest->attachment = $path;
        }

        $staff->leaveRequests()->save($leaveRequest);

        return redirect()->route('staff.leave-requests.index')
            ->with('success', 'Leave request submitted successfully.');
    }

    public function show(LeaveRequest $leaveRequest)
    {
        if ($leaveRequest->staff_id !== Auth::guard('staff')->id()) {
            abort(403);
        }

        return view('staff.leave-requests.show', compact('leaveRequest'));
    }

    public function cancel(LeaveRequest $leaveRequest)
    {
        if ($leaveRequest->staff_id !== Auth::guard('staff')->id()) {
            abort(403);
        }

        if (!$leaveRequest->isPending()) {
            return back()->with('error', 'Only pending leave requests can be cancelled.');
        }

        $leaveRequest->delete();

        return redirect()->route('staff.leave-requests.index')
            ->with('success', 'Leave request cancelled successfully.');
    }
}