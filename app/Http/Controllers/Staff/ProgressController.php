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
            'staff_id' => 'required|exists:staff,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'files.*' => 'nullable|file|max:10240'
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $workProgress = WorkProgress::create([
            'staff_id' => $request->staff_id,
            'title' => $request->title,
            'description' => $request->description,
            'status' => 'pending'
        ]);

        if ($request->hasFile('files')) {
            foreach ($request->file('files') as $file) {
                $path = $file->store('work-progress/' . $request->staff_id, 'public');
                
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