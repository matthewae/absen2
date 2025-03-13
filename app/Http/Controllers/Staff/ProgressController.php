<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\WorkProgress;
use App\Models\WorkProgressFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProgressController extends Controller
{
    public function index(Request $request)
    {   
        $workProgresses = WorkProgress::with(['staff', 'files'])
            ->latest()
            ->paginate(10);

        return view('staff.work-progress.index', compact('workProgresses'));
    }

    public function create()
    {
        return view('staff.work-progress.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_topic' => ['required', 'string', Rule::in(['Perencanaan', 'Pengawasan', 'Kajian'])],
            'company_name' => 'required|string|max:255',
            'work_description' => 'required|string|min:100',
            'files.*' => 'required|file|max:153600' // 150MB max per file
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        if (!auth()->check() || !auth()->user()->staff) {
            return back()
                ->withErrors(['error' => 'Unauthorized. Staff record not found.'])
                ->withInput();
        }

        $workProgress = WorkProgress::create([
            'staff_id' => auth()->user()->staff->id,
            'project_topic' => $request->project_topic,
            'company_name' => $request->company_name,
            'work_description' => $request->work_description,
            'status' => 'pending'
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('work-progress/' . auth()->user()->staff->id, 'public');
                
                WorkProgressFile::create([
                    'work_progress_id' => $workProgress->id,
                    'file_path' => $path,
                    'original_name' => $file->getClientOriginalName(),
                    'mime_type' => $file->getMimeType(),
                    'size' => $file->getSize()
                ]);
            }
        }

        return redirect()->route('staff.work-progress.index')
            ->with('success', 'Work progress created successfully.');
    }

    public function show(WorkProgress $workProgress)
    {
        return view('staff.work-progress.show', compact('workProgress'));
    }
}