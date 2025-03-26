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

        try {
            $filePath = Storage::disk('public')->path($file->file_path);
            
            if (!file_exists($filePath)) {
                abort(404, 'File not found on disk');
            }

            return response()->file($filePath, [
                'Content-Type' => $file->mime_type ?: 'application/octet-stream',
                'Content-Disposition' => 'attachment; filename="' . $file->original_name . '"',
                'Content-Length' => $file->file_size,
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache',
                'Expires' => '0'
            ]);
        } catch (\Exception $e) {
            \Log::error('File download error:', [
                'file_id' => $file->id,
                'path' => $file->file_path,
                'error' => $e->getMessage()
            ]);
            abort(500, 'Error downloading file');
        }
    }
}