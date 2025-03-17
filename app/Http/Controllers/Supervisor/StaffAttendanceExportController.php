<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\Attendance;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Carbon\Carbon;

class StaffAttendanceExportController extends Controller
{
    public function export(Staff $staff)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'Date');
        $sheet->setCellValue('B1', 'Check In');
        $sheet->setCellValue('C1', 'Check Out');
        $sheet->setCellValue('D1', 'Duration (Hours)');
        $sheet->setCellValue('E1', 'Status');

        // Style headers
        $sheet->getStyle('A1:E1')->getFont()->setBold(true);

        // Get attendance records for current month
        $records = Attendance::where('staff_id', $staff->id)
            ->whereMonth('check_in', Carbon::now()->month)
            ->whereYear('check_in', Carbon::now()->year)
            ->orderBy('check_in')
            ->get();

        $row = 2;
        foreach ($records as $record) {
            $sheet->setCellValue('A' . $row, $record->check_in->format('d M Y'));
            $sheet->setCellValue('B' . $row, $record->check_in->format('H:i'));
            $sheet->setCellValue('C' . $row, $record->check_out ? $record->check_out->format('H:i') : '-');
            $sheet->setCellValue('D' . $row, $record->check_out ? $record->check_in->diffInHours($record->check_out) : '-');
            $sheet->setCellValue('E' . $row, $record->check_out ? 'Completed' : 'On Duty');
            $row++;
        }

        // Auto size columns
        foreach (range('A', 'E') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Create the Excel file
        $writer = new Xlsx($spreadsheet);
        $filename = $staff->name . '_attendance_' . Carbon::now()->format('F_Y') . '.xlsx';

        // Create response
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        exit;
    }
}