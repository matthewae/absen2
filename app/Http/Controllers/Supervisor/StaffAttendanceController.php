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
            $perPage = 10;
            $page = $request->input('page', 1);
            $staffMembers = Staff::where('supervisor_id', auth()->user()->id)
                ->paginate($perPage);
        }

        // Eager load attendances to avoid N+1 queries
        $staffMembers->load(['attendances' => function($query) {
            $query->whereMonth('check_in', now()->month)
                  ->whereYear('check_in', now()->year);
        }]);

        return view('supervisor.staff-attendance', [
            'staffMembers' => $staffMembers,
            'staff' => $staff_id ? $staff : null,
            'page' => $page
        ]);
    }

    public function exportAttendance($staff_id)
    {
        $staff = Staff::findOrFail($staff_id);
        $exportController = new StaffAttendanceExportController();
        return $exportController->export($staff);
    }

    public function exportAllAttendance()
    {
        $staffMembers = Staff::where('supervisor_id', auth()->user()->id)->get();
        $exportController = new StaffAttendanceExportController();
        return $exportController->exportAll($staffMembers);
    }
}