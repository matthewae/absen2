<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\Attendance;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

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
        $headers = [
            'A' => 'Staff Name',
            'B' => 'Department',
            'C' => 'Date',
            'D' => 'Status',
            'E' => 'Check In',
            'F' => 'Check Out',
            'G' => 'Duration (Hours)'
        ];

        foreach ($headers as $col => $header) {
            $sheet->setCellValue($col . '1', $header);
        }

        // Style the header row
        $headerStyle = [
            'font' => ['bold' => true],
            'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['rgb' => 'E0E0E0']],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
        ];
        $sheet->getStyle('A1:G1')->applyFromArray($headerStyle);

        $row = 2;
        $query = Attendance::with('staff')
            ->whereMonth('check_in', now()->month)
            ->whereYear('check_in', now()->year)
            ->orderBy('check_in', 'asc');

        if ($staffId) {
            $query->where('staff_id', $staffId);
            $filename = Staff::find($staffId)->name . '_attendance_record_' . now()->format('F_Y') . '.xls';
        } else {
            $filename = 'all_staff_attendance_record_' . now()->format('F_Y') . '.xls';
        }

        $attendances = $query->get();
        $weeklyAttendances = $attendances->groupBy(function($attendance) {
            return $attendance->check_in->format('W'); // Group by week number
        });

        // Style for week header
        $weekHeaderStyle = [
            'font' => ['bold' => true],
            'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID, 'color' => ['rgb' => 'B8CCE4']],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]
        ];

        foreach ($weeklyAttendances as $weekNumber => $weekAttendances) {
            // Add week header
            $firstDate = $weekAttendances->first()->check_in->startOfWeek()->format('d/m/Y');
            $lastDate = $weekAttendances->first()->check_in->endOfWeek()->format('d/m/Y');
            $sheet->mergeCells("A{$row}:G{$row}");
            $sheet->setCellValue("A{$row}", "Minggu {$weekNumber} ({$firstDate} - {$lastDate})");
            $sheet->getStyle("A{$row}:G{$row}")->applyFromArray($weekHeaderStyle);
            $row++;

            // Add attendance records for the week
            foreach ($weekAttendances as $attendance) {
                $this->writeAttendanceRow($sheet, $row, $attendance->staff, $attendance);
                $row++;
            }

            // Add empty row between weeks
            $row++;
        }

        // Auto-size columns
        foreach (range('A', 'G') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Set column formats
        $sheet->getStyle('C2:C' . ($row-1))->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDD);
        $sheet->getStyle('E2:F' . ($row-1))->getNumberFormat()->setFormatCode(NumberFormat::FORMAT_DATE_DATETIME);

        // Create Xls writer object
        $writer = new Xls($spreadsheet);

        // Set headers for download
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        // Save file to PHP output
        $writer->save('php://output');
        exit();

        // Set column alignment
        $sheet->getStyle('A2:G' . ($row-1))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Create the Excel file
        $writer = new Xlsx($spreadsheet);
        $path = storage_path('app/public/' . $filename);
        $writer->save($path);

        return response()->download($path)->deleteFileAfterSend();
    }

    private function writeAttendanceRow($sheet, $row, $staff, $attendance)
    {
        $sheet->setCellValue('A' . $row, $staff->name);
        $sheet->setCellValue('B' . $row, $staff->department);
        $sheet->setCellValue('C' . $row, $attendance->check_in->format('Y-m-d'));
        $sheet->setCellValue('D' . $row, ucfirst($attendance->status));
        $sheet->setCellValue('E' . $row, $attendance->check_in->format('Y-m-d H:i:s'));
        
        if ($attendance->check_out) {
            $sheet->setCellValue('F' . $row, $attendance->check_out->format('Y-m-d H:i:s'));
            // Calculate duration in hours with 2 decimal places
            $duration = number_format($attendance->check_in->diffInMinutes($attendance->check_out) / 60, 2);
        } else {
            $sheet->setCellValue('F' . $row, '-');
            $duration = '-';
        }
        
        $sheet->setCellValue('G' . $row, $duration);
    }

    public function exportAll(Request $request)
    {
        return $this->export($request);
    }
}