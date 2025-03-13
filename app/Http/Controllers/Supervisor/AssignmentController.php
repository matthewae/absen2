<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AssignmentController extends Controller
{
    public function index()
    {
        $supervisor = Auth::guard('supervisor')->user();
        $assignments = $supervisor->assignments()
            ->with(['staff'])
            ->latest()
            ->paginate(10);

        return view('supervisor.assignments.index', compact('assignments'));
    }

    public function create()
    {
        $supervisor = Auth::guard('supervisor')->user();
        $staff = $supervisor->staff()->get();
        return view('supervisor.assignments.create', compact('staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'staff_id' => 'required|exists:staff,id',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
            'priority' => 'required|in:low,medium,high'
        ]);

        $supervisor = Auth::guard('supervisor')->user();
        $assignment = new Assignment($request->all());
        $assignment->supervisor_id = $supervisor->id;
        $assignment->save();

        return redirect()->route('supervisor.assignments.index')
            ->with('success', 'Assignment created successfully.');
    }

    public function show(Assignment $assignment)
    {
        if ($assignment->supervisor_id !== Auth::guard('supervisor')->id()) {
            abort(403);
        }

        return view('supervisor.assignments.show', compact('assignment'));
    }

    public function edit(Assignment $assignment)
    {
        if ($assignment->supervisor_id !== Auth::guard('supervisor')->id()) {
            abort(403);
        }

        $supervisor = Auth::guard('supervisor')->user();
        $staff = $supervisor->staff()->get();
        
        return view('supervisor.assignments.edit', compact('assignment', 'staff'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        if ($assignment->supervisor_id !== Auth::guard('supervisor')->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'staff_id' => 'required|exists:staff,id',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime',
            'priority' => 'required|in:low,medium,high',
            'status' => 'required|in:pending,in_progress,completed'
        ]);

        $assignment->update($request->all());

        return redirect()->route('supervisor.assignments.index')
            ->with('success', 'Assignment updated successfully.');
    }

    public function destroy(Assignment $assignment)
    {
        if ($assignment->supervisor_id !== Auth::guard('supervisor')->id()) {
            abort(403);
        }

        $assignment->delete();

        return redirect()->route('supervisor.assignments.index')
            ->with('success', 'Assignment deleted successfully.');
    }

    public function downloadAttachment(Assignment $assignment)
    {
        if ($assignment->supervisor_id !== Auth::guard('supervisor')->id()) {
            abort(403);
        }

        if (!$assignment->attachment) {
            abort(404, 'No attachment found.');
        }

        return Storage::download($assignment->attachment);
    }
}