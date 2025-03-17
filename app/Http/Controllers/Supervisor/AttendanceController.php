<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use App\Models\Attendance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class AttendanceController extends Controller
{
    public function export(Staff $staff)
    {
        $attendances = $staff->attendances()
            ->orderBy('check_in', 'desc')
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers with styling
        $headers = ['Date', 'Check In', 'Check Out', 'Duration (Hours)', 'Status'];
        foreach ($headers as $key => $header) {
            $column = chr(65 + $key); // Convert number to letter (A, B, C, etc.)
            $sheet->setCellValue($column . '1', $header);
        }

        // Style the header row
        $headerStyle = [
            'font' => ['bold' => true],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'E2EFDA']
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN
                ]
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER
            ]
        ];
        $sheet->getStyle('A1:E1')->applyFromArray($headerStyle);

        // Add attendance records
        $row = 2;
        foreach ($attendances as $attendance) {
            $duration = $attendance->check_out 
                ? $attendance->check_in->diffInHours($attendance->check_out) 
                : '-';

            $sheet->setCellValue('A' . $row, $attendance->check_in->format('Y-m-d'));
            $sheet->setCellValue('B' . $row, $attendance->check_in->format('H:i'));
            $sheet->setCellValue('C' . $row, $attendance->check_out ? $attendance->check_out->format('H:i') : '-');
            $sheet->setCellValue('D' . $row, $duration);
            $sheet->setCellValue('E' . $row, $attendance->check_out ? 'Completed' : 'On Duty');

            // Style the data rows
            $dataStyle = [
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN
                    ]
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER
                ]
            ];
            $sheet->getStyle('A' . $row . ':E' . $row)->applyFromArray($dataStyle);

            $row++;
        }

        // Auto-size columns
        foreach (range('A', 'E') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        // Create the Excel file
        $fileName = $staff->name . '_attendance_' . now()->format('Y-m-d') . '.xlsx';
        $writer = new Xlsx($spreadsheet);

        // Save to temporary file and return response
        $temp_file = tempnam(sys_get_temp_dir(), 'excel');
        $writer->save($temp_file);

        return response()->download($temp_file, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ])->deleteFileAfterSend(true);
    }
}