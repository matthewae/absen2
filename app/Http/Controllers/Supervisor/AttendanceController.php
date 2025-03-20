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
        $attendances = Attendance::with(['staff'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        $staffMembers = Staff::with('attendances')->get();
        $staff = null; // Initialize $staff variable to avoid undefined variable error
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
                $sheet->setCellValue('C' . $row, $attendance->date);
                $sheet->setCellValue('D' . $row, ucfirst($attendance->status));
                $sheet->setCellValue('E' . $row, $attendance->check_in);
                $sheet->setCellValue('F' . $row, $attendance->check_out);
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
                    $sheet->setCellValue('C' . $row, $attendance->date);
                    $sheet->setCellValue('D' . $row, ucfirst($attendance->status));
                    $sheet->setCellValue('E' . $row, $attendance->check_in);
                    $sheet->setCellValue('F' . $row, $attendance->check_out);
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
        
        // Set headers for download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Save to output
        $writer->save('php://output');
        exit;
    }
}