<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\WorkProgress;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class WorkProgressController extends Controller
{
    public function index()
    {
        $staffMembers = Staff::with(['workProgress' => function($query) {
            $query->latest();
        }])->paginate(6);

        return view('supervisor.work-progress.index', compact('staffMembers'));
    }

    public function show(Staff $staff)
    {
        $workProgress = $staff->workProgress()
            ->with('files')
            ->latest()
            ->paginate(10);

        return view('supervisor.work-progress.show', compact('staff', 'workProgress'));
    }

    public function viewProgress(WorkProgress $workProgress)
    {
        $this->authorize('view', $workProgress);

        return view('supervisor.work-progress.view', compact('workProgress'));
    }

    public function approve(WorkProgress $workProgress)
    {
        $this->authorize('update', $workProgress);

        $workProgress->update([
            'status' => 'approved',
            'reviewed_at' => now()
        ]);

        return redirect()
            ->back()
            ->with('success', 'Work progress has been approved successfully.');
    }

    public function reject(Request $request, WorkProgress $workProgress)
    {
        $this->authorize('update', $workProgress);

        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $workProgress->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason'],
            'reviewed_at' => now()
        ]);

        return redirect()
            ->back()
            ->with('success', 'Work progress has been rejected.');
    }

    public function downloadFile(\App\Models\WorkProgressFile $file)
    {
        // Load the workProgress relationship and verify authorization
        $file->load('workProgress');
        $this->authorize('view', $file->workProgress);

        // Verify file existence
        if (!Storage::disk('public')->exists($file->file_path)) {
            \Log::error('File not found:', ['file' => $file->original_name, 'path' => $file->file_path]);
            abort(404, 'File not found');
        }

        // Get file path and verify readability
        $filePath = Storage::disk('public')->path($file->file_path);
        if (!is_readable($filePath)) {
            \Log::error('File not readable:', ['file' => $file->original_name, 'path' => $filePath]);
            abort(500, 'File not accessible');
        }

        // Verify file integrity
        $actualSize = Storage::disk('public')->size($file->file_path);
        if ($actualSize !== $file->file_size) {
            \Log::error('File size mismatch:', [
                'file' => $file->original_name,
                'expected' => $file->file_size,
                'actual' => $actualSize,
                'path' => $file->file_path
            ]);
            abort(500, 'File integrity check failed');
        }

        // Determine MIME type
        $mimeType = $file->mime_type;
        if (!$mimeType || $mimeType === 'application/octet-stream') {
            $mimeType = Storage::disk('public')->mimeType($file->file_path) ?: 'application/octet-stream';
        }

        // Set secure headers for file download
        $headers = [
            'Content-Type' => $mimeType,
            'Content-Length' => $actualSize,
            'Content-Disposition' => 'attachment; filename*=UTF-8\'\''. rawurlencode($file->original_name),
            'Cache-Control' => 'private, no-transform, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
            'X-Content-Type-Options' => 'nosniff'
        ];

        // Stream the file using readfile for direct binary output
        return response()->stream(
            function () use ($filePath) {
                $handle = fopen($filePath, 'rb');
                if ($handle === false) {
                    abort(500, 'Failed to open file');
                }
                while (!feof($handle)) {
                    echo fread($handle, 8192);
                    flush();
                }
                fclose($handle);
            },
            200,
            $headers
        );
    }
}