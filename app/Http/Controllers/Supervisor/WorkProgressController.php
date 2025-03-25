<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\WorkProgress;
use App\Models\Staff;
use Illuminate\Http\Request;

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

    public function downloadFile(WorkProgressFile $file)
    {
        $this->authorize('view', $file->workProgress);

        $path = storage_path('app/' . $file->file_path);

        if (!file_exists($path)) {
            abort(404, 'File not found');
        }

        return response()->download($path, $file->original_name);
    }
}