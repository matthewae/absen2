<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\WorkProgress;
use App\Models\WorkProgressFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class WorkProgressController extends Controller
{
    public function __construct()
    {
        // Authentication is handled at dashboard level
    }

    public function index()
    {
        $workProgresses = WorkProgress::with('files')
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
            'status' => ['required', 'string', Rule::in(['pending', 'in_progress', 'completed'])],
            'files.*' => 'required|file|max:153600' // 150MB max per file
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $staff = auth()->user()->staff;
        if (!$staff) {
            return back()->with('error', 'No staff record found for your account. Please contact your supervisor.');
        }

        if ($request->hasFile('files')) {
            $workProgress = WorkProgress::create([
                'staff_id' => $staff->id,
                'user_id' => auth()->id(),
                'project_topic' => $request->project_topic,
                'company_name' => $request->company_name,
                'work_description' => $request->work_description,
                'status' => $request->status,
                'title' => $request->project_topic . ' - ' . $request->company_name,
                'description' => $request->work_description,
                'start_date' => now()
            ]);

            foreach ($request->file('files') as $file) {
                $path = $file->store('work-progress/' . $staff->id, 'public');
                
                WorkProgressFile::create([
                    'work_progress_id' => $workProgress->id,
                    'original_name' => $file->getClientOriginalName(),
                    'file_path' => $path,
                    'mime_type' => $file->getMimeType(),
                    'file_size' => $file->getSize()
                ]);
            }

            return redirect()->route('staff.work-progress.index')
                ->with('success', 'Work progress submitted successfully.');
        }

        return back()->with('error', 'Please upload at least one file.');
    }

    public function show(WorkProgress $workProgress)
    {
        $this->authorize('view', $workProgress);
        return view('staff.work-progress.show', compact('workProgress'));
    }
}