<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\LeaveRequest;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:supervisor');
    }

    public function index(Request $request)
    {
        $staff_id = $request->query('staff_id');
        $query = Staff::query()->with('leaveRequests.approvedBy');
        
        if ($staff_id) {
            $query->where('staff_id', 'like', '%' . $staff_id . '%');
        }
        
        $staff = $query->paginate(10);
        $leaveRequests = LeaveRequest::with(['staff', 'approvedBy'])
            ->latest()
            ->get();
        return view('supervisor.staff.index', compact('staff', 'leaveRequests'));
    }

    public function show(Staff $staff)
    {
        return view('supervisor.staff.show', compact('staff'));
    }

    public function edit(Staff $staff)
    {
        return view('supervisor.staff.edit', compact('staff'));
    }

    public function update(Request $request, Staff $staff)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:staff,email,' . $staff->id,
            'phone_number' => 'required|string|max:20',
            'position' => 'required|string|max:255'
        ]);

        $staff->update($validated);

        return redirect()->route('supervisor.staff.show', $staff)
            ->with('success', 'Staff information updated successfully.');
    }
}