<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\Attendance;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class AttendanceController extends Controller
{
    public function index()
    {
        $staffMembers = Staff::with(['attendances' => function($query) {
            $query->whereMonth('check_in', now()->month)
                  ->whereYear('check_in', now()->year);
        }])->get();

        $staff = null; // Initialize $staff variable to avoid undefined variable error

        // Calculate attendance statistics for each staff member
        $staffMembers->each(function($staff) {
            $staff->present_count = $staff->attendances()
                ->where('status', 'present')
                ->whereDate('check_in', '>=', now()->startOfMonth())
                ->whereDate('check_in', '<=', now()->endOfMonth())
                ->count();
            
            $staff->absent_count = $staff->attendances()
                ->where('status', 'absent')
                ->whereDate('check_in', '>=', now()->startOfMonth())
                ->whereDate('check_in', '<=', now()->endOfMonth())
                ->count();
            
            $staff->leave_count = $staff->attendances()
                ->where('status', 'leave')
                ->whereDate('check_in', '>=', now()->startOfMonth())
                ->whereDate('check_in', '<=', now()->endOfMonth())
                ->count();
        });

        return view('supervisor.staff-attendance', compact('staffMembers', 'staff'));
    }

    public function export(Request $request, $staffId = null)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'Staff Name');
        $sheet->setCellValue('B1', 'Department');
        $sheet->setCellValue('C1', 'Date');
        $sheet->setCellValue('D1', 'Status');
        $sheet->setCellValue('E1', 'Check In');
        $sheet->setCellValue('F1', 'Check Out');

        $row = 2;

        if ($staffId) {
            // Export single staff attendance
            $staff = Staff::findOrFail($staffId);
            $attendances = $staff->attendances()->orderBy('check_in', 'desc')->get();

            foreach ($attendances as $attendance) {
                $sheet->setCellValue('A' . $row, $staff->name);
                $sheet->setCellValue('B' . $row, $staff->department);
                $sheet->setCellValue('C' . $row, $attendance->check_in->format('Y-m-d'));
                $sheet->setCellValue('D' . $row, ucfirst($attendance->status));
                $sheet->setCellValue('E' . $row, $attendance->check_in->format('H:i:s'));
                $sheet->setCellValue('F' . $row, $attendance->check_out ? $attendance->check_out->format('H:i:s') : '-');
                $row++;
            }

            $filename = $staff->name . '_attendance_record.xlsx';
        } else {
            // Export all staff attendance
            $staffMembers = Staff::with('attendances')->get();

            foreach ($staffMembers as $staff) {
                foreach ($staff->attendances()->orderBy('check_in', 'desc')->get() as $attendance) {
                    $sheet->setCellValue('A' . $row, $staff->name);
                    $sheet->setCellValue('B' . $row, $staff->department);
                    $sheet->setCellValue('C' . $row, $attendance->check_in->format('Y-m-d'));
                    $sheet->setCellValue('D' . $row, ucfirst($attendance->status));
                    $sheet->setCellValue('E' . $row, $attendance->check_in->format('H:i:s'));
                    $sheet->setCellValue('F' . $row, $attendance->check_out ? $attendance->check_out->format('H:i:s') : '-');
                    $row++;
                }
            }

            $filename = 'all_staff_attendance_record.xlsx';
        }

        // Auto-size columns
        foreach (range('A', 'F') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Create the Excel file
        $writer = new Xlsx($spreadsheet);
        $path = storage_path('app/public/' . $filename);
        $writer->save($path);

        return response()->download($path)->deleteFileAfterSend();
    }
}