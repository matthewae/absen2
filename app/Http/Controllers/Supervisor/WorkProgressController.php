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
        }])->get();

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
        $this->authorize('view', $file->workProgress);

        if (!Storage::disk('public')->exists($file->file_path)) {
            abort(404, 'File not found');
        }

        // Verify file integrity before sending
        $actualSize = Storage::disk('public')->size($file->file_path);
        if ($actualSize !== $file->file_size) {
            \Log::error('File size mismatch:', [
                'file' => $file->original_name,
                'expected' => $file->file_size,
                'actual' => $actualSize
            ]);
            abort(500, 'File integrity check failed');
        }

        // Get the MIME type from the stored file if not available in the database
        $mimeType = $file->mime_type;
        if (!$mimeType || $mimeType === 'application/octet-stream') {
            $mimeType = Storage::disk('public')->mimeType($file->file_path) ?: 'application/octet-stream';
        }

        // Set appropriate headers for the file type
        $headers = [
            'Content-Type' => $mimeType,
            'Content-Length' => $actualSize,
            'Content-Disposition' => 'attachment; filename="' . rawurlencode($file->original_name) . '"',
            'Cache-Control' => 'private, no-transform, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ];

        // Stream the file response
        return Storage::disk('public')->response($file->file_path, $file->original_name, $headers);
    }
}