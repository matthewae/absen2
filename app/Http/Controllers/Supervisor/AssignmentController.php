<?php

namespace App\Http\Controllers\Supervisor;

use App\Models\Supervisor;
use App\Models\Assignment;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with(['staff'])->latest()->paginate(10);
        $staff = \App\Models\Staff::all();
        return view('supervisor.assignments.index', compact('assignments', 'staff'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'staff_id' => 'required|exists:staff,id',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime'
        ]);

        $assignment = Assignment::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'staff_id' => $validated['staff_id'],
            'supervisor_id' => auth()->id(),
            'start_datetime' => $validated['start_datetime'],
            'end_datetime' => $validated['end_datetime'],
            'status' => 'in_progress'
        ]);

        return redirect()->route('supervisor.assignments.index')
            ->with('success', 'Assignment created successfully');
    }

    public function profile()
    {
        $supervisor = auth()->user();
        return view('supervisor.profile', [
            'supervisor' => $supervisor,
            'title' => 'Profile'
        ]);
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        try {
            $supervisor = auth()->user();

            if ($request->hasFile('profile_picture')) {
                // Delete old profile picture if exists
                if ($supervisor->profile_picture) {
                    Storage::disk('public')->delete($supervisor->profile_picture);
                }

                // Store new profile picture
                $file = $request->file('profile_picture');
                $filename = 'supervisor_' . $supervisor->id . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('profile-pictures', $filename, 'public');

                // Update supervisor profile
                $supervisor->profile_picture = $path;
                $supervisor->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Profile picture updated successfully',
                    'path' => Storage::url($path)
                ]);
            }

            return response()->json([
                'success' => false,
                'message' => 'No file uploaded'
            ], 400);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating profile picture: ' . $e->getMessage()
            ], 500);
        }
    }

    public function create()
    {
        $staff = Staff::all();
        return view('supervisor.assignments.create', compact('staff'));
    }

    public function show(Assignment $assignment)
    {
        $assignment->load('staff');
        return view('supervisor.assignments.show', compact('assignment'));
    }

    public function edit(Assignment $assignment)
    {
        $staff = Staff::all();
        return view('supervisor.assignments.edit', compact('assignment', 'staff'));
    }

    public function update(Request $request, Assignment $assignment)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'staff_id' => 'required|exists:staff,id',
            'start_datetime' => 'required|date',
            'end_datetime' => 'required|date|after:start_datetime'
        ]);

        $assignment->update([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'staff_id' => $validated['staff_id'],
            'start_datetime' => $validated['start_datetime'],
            'end_datetime' => $validated['end_datetime']
        ]);

        return redirect()->route('supervisor.assignments.show', $assignment)
            ->with('success', 'Assignment updated successfully');
    }

    public function destroy(Assignment $assignment)
    {
        if ($assignment->supervisor_id !== auth()->id()) {
            abort(403, 'Unauthorized action');
        }

        $assignment->delete();

        return redirect()->route('supervisor.assignments.index')
            ->with('success', 'Assignment deleted successfully');
    }
}