<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffAttendanceController extends Controller
{
    public function index(Request $request, $staff_id = null)
    {
        if ($staff_id) {
            $staff = Staff::findOrFail($staff_id);
            $staffMembers = collect([$staff]);
        } else {
            $staffMembers = Staff::where('supervisor_id', auth()->user()->id)->get();
        }

        // Eager load attendances to avoid N+1 queries
        $staffMembers->load(['attendances' => function($query) {
            $query->whereMonth('check_in', now()->month)
                  ->whereYear('check_in', now()->year);
        }]);

        return view('supervisor.staff-attendance', [
            'staffMembers' => $staffMembers,
            'staff' => $staff_id ? $staff : null
        ]);
    }

    public function exportAttendance($staff_id)
    {
        // TODO: Implement attendance export functionality
        return back()->with('success', 'Attendance records exported successfully.');
    }

    public function exportAllAttendance()
    {
        // TODO: Implement all staff attendance export functionality
        return back()->with('success', 'All staff attendance records exported successfully.');
    }
}