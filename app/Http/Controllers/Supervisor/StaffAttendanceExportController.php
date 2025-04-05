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
    public function exportAll($staffMembers)
    {
        if (!$staffMembers || $staffMembers->isEmpty()) {
            abort(404, 'No staff members found to export.');
        }

        try {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'Staff Name');
        $sheet->setCellValue('B1', 'Date');
        $sheet->setCellValue('C1', 'Check In');
        $sheet->setCellValue('D1', 'Check Out');
        $sheet->setCellValue('E1', 'Duration (Hours)');
        $sheet->setCellValue('F1', 'Status');
        $sheet->setCellValue('G1', 'Location');
        $sheet->setCellValue('H1', 'Work Progress');
        $sheet->setCellValue('I1', 'Work Submitted');

        // Style headers
        $sheet->getStyle('A1:I1')->getFont()->setBold(true);

        $row = 2;
        foreach ($staffMembers as $staff) {
            $records = Attendance::where('staff_id', $staff->id)
                ->whereMonth('check_in', Carbon::now()->month)
                ->whereYear('check_in', Carbon::now()->year)
                ->orderBy('check_in')
                ->get();

            foreach ($records as $record) {
                $sheet->setCellValue('A' . $row, $staff->name);
                $sheet->setCellValue('B' . $row, $record->check_in->format('Y-m-d'));
                $sheet->setCellValue('C' . $row, $record->check_in->format('H:i:s'));
                $sheet->setCellValue('D' . $row, $record->check_out ? $record->check_out->format('H:i:s') : '-');
                $sheet->setCellValue('E' . $row, $record->check_out ? number_format($record->check_in->diffInHours($record->check_out), 2) : '-');
                $sheet->setCellValue('F' . $row, ucfirst($record->status));
                $sheet->setCellValue('G' . $row, $record->location ?? '-');
                $sheet->setCellValue('H' . $row, $record->work_progress ?? '-');
                $sheet->setCellValue('I' . $row, $record->is_work_submitted ? 'Yes' : 'No');
                $row++;
            }
        }

        // Format date and time columns
        $sheet->getStyle('B2:B' . ($row-1))->getNumberFormat()->setFormatCode('yyyy-mm-dd');
        $sheet->getStyle('C2:D' . ($row-1))->getNumberFormat()->setFormatCode('hh:mm:ss');

        // Auto size columns
        foreach (range('A', 'I') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Create Excel file
        $writer = new Xlsx($spreadsheet);
        $filename = 'All_Staff_Attendance_' . Carbon::now()->format('Y_m') . '.xlsx';

        $tempFile = tempnam(sys_get_temp_dir(), 'excel');
        $writer->save($tempFile);

        return response()->download($tempFile, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"'
        ])->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            if (isset($tempFile) && file_exists($tempFile)) {
                unlink($tempFile);
            }
            abort(500, 'Error generating export file: ' . $e->getMessage());
        }
        } catch (\Exception $e) {
            if (isset($tempFile) && file_exists($tempFile)) {
                unlink($tempFile);
            }
            abort(500, 'Error generating export file: ' . $e->getMessage());
        }
    }

    public function export(Staff $staff)
    {
        try {
            $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'Date');
        $sheet->setCellValue('B1', 'Check In');
        $sheet->setCellValue('C1', 'Check Out');
        $sheet->setCellValue('D1', 'Duration (Hours)');
        $sheet->setCellValue('E1', 'Status');
        $sheet->setCellValue('F1', 'Location');
        $sheet->setCellValue('G1', 'Work Progress');
        $sheet->setCellValue('H1', 'Work Submitted');

        // Style headers
        $sheet->getStyle('A1:H1')->getFont()->setBold(true);

        // Get attendance records for current month
        $records = Attendance::where('staff_id', $staff->id)
            ->whereMonth('check_in', Carbon::now()->month)
            ->whereYear('check_in', Carbon::now()->year)
            ->orderBy('check_in')
            ->get();

        $row = 2;
        foreach ($records as $record) {
            $sheet->setCellValue('A' . $row, $record->check_in->format('Y-m-d'));
            $sheet->setCellValue('B' . $row, $record->check_in->format('H:i:s'));
            $sheet->setCellValue('C' . $row, $record->check_out ? $record->check_out->format('H:i:s') : '-');
            $sheet->setCellValue('D' . $row, $record->check_out ? number_format($record->check_in->diffInHours($record->check_out), 2) : '-');
            $sheet->setCellValue('E' . $row, ucfirst($record->status));
            $sheet->setCellValue('F' . $row, $record->location ?? '-');
            $sheet->setCellValue('G' . $row, $record->work_progress ?? '-');
            $sheet->setCellValue('H' . $row, $record->is_work_submitted ? 'Yes' : 'No');
            $row++;
        }

        // Format date and time columns
        $sheet->getStyle('A2:A' . ($row-1))->getNumberFormat()->setFormatCode('yyyy-mm-dd');
        $sheet->getStyle('B2:C' . ($row-1))->getNumberFormat()->setFormatCode('hh:mm:ss');

        // Auto size columns
        foreach (range('A', 'H') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Create Excel file
        $writer = new Xlsx($spreadsheet);
        $filename = 'Staff_Attendance_' . $staff->name . '_' . Carbon::now()->format('Y_m') . '.xlsx';

        $tempFile = tempnam(sys_get_temp_dir(), 'excel');
        $writer->save($tempFile);

        return response()->download($tempFile, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"'
        ])->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            if (isset($tempFile) && file_exists($tempFile)) {
                unlink($tempFile);
            }
            abort(500, 'Error generating export file: ' . $e->getMessage());
        }
    }
}