<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WorkProgress;
use App\Models\WorkProgressFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class WorkProgressController extends Controller
{
    public function index(Request $request)
    {
        $query = WorkProgress::with(['staff', 'files']);

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $workProgresses = $query->latest()->paginate(10);

        return view('work-progress.index', compact('workProgresses'));
    }

    public function create()
    {
        return view('work-progress.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'company_name' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'files.*' => 'nullable|file|max:153600'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $workProgress = WorkProgress::create([
            'staff_id' => auth()->user()->staff->id,
            'company_name' => $request->company_name,
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'pending',
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('work-progress-files', 'public');
                
                $workProgress->files()->create([
                    'original_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'mime_type' => $file->getMimeType(),
                    'file_size' => $file->getSize()
                ]);
            }
        }

        return redirect()->route('work-progress.show', $workProgress)
            ->with('success', 'Work progress created successfully.');
    }

    public function show(WorkProgress $workProgress)
    {
        $this->authorize('view', $workProgress);
        $workProgress->load(['staff', 'files']);

        return view('work-progress.show', compact('workProgress'));
    }

    public function edit(WorkProgress $workProgress)
    {
        $this->authorize('update', $workProgress);
        return view('work-progress.edit', compact('workProgress'));
    }

    public function update(Request $request, WorkProgress $workProgress)
    {
        $this->authorize('update', $workProgress);

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => ['required', Rule::in(['pending', 'in_progress', 'completed', 'rejected'])],
            'feedback' => 'nullable|string',
            'files.*' => 'nullable|file|max:10240'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $workProgress->update([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'feedback' => $request->feedback
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('work-progress-files', 'public');
                
                $workProgress->files()->create([
                    'original_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'mime_type' => $file->getMimeType(),
                    'file_size' => $file->getSize()
                ]);
            }
        }

        return redirect()->route('work-progress.show', $workProgress)
            ->with('success', 'Work progress updated successfully.');
    }

    public function destroy(WorkProgress $workProgress)
    {
        $this->authorize('delete', $workProgress);

        foreach ($workProgress->files as $file) {
            Storage::disk('public')->delete($file->file_path);
        }

        $workProgress->delete();

        return redirect()->route('work-progress.index')
            ->with('success', 'Work progress deleted successfully.');
    }
}