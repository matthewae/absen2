<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\WorkProgress;
use App\Models\WorkProgressFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class StaffProgressController extends Controller
{
    public function index()
    {
        $workProgresses = WorkProgress::with(['staff', 'files'])
            ->whereHas('staff', function ($query) {
                $query->where('supervisor_id', auth()->id());
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('supervisor.staff-progress.index', compact('workProgresses'));
    }

    public function downloadFiles(Request $request)
    {
        $selectedIds = $request->input('selected_files', []);
        $zip = new ZipArchive();
        $zipFileName = 'work-progress-files-' . now()->format('Y-m-d-H-i-s') . '.zip';
        $zipPath = storage_path('app/temp/' . $zipFileName);

        if ($zip->open($zipPath, ZipArchive::CREATE) === TRUE) {
            if (empty($selectedIds)) {
                // Download all files if no specific files are selected
                $files = WorkProgressFile::whereHas('workProgress.staff', function ($query) {
                    $query->where('supervisor_id', auth()->id());
                })->get();
            } else {
                $files = WorkProgressFile::whereIn('id', $selectedIds)
                    ->whereHas('workProgress.staff', function ($query) {
                        $query->where('supervisor_id', auth()->id());
                    })->get();
            }

            foreach ($files as $file) {
                if (Storage::exists($file->file_path)) {
                    $zip->addFile(storage_path('app/' . $file->file_path), $file->original_name);
                }
            }

            $zip->close();

            return response()->download($zipPath)->deleteFileAfterSend(true);
        }

        return back()->with('error', 'Could not create zip file');
    }
}