<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Staff;
use Illuminate\Http\Request;

class AssignmentsController extends Controller
{
    public function index()
    {
        // Get all staff members for the filter dropdown
        $staff = Staff::all();
        
        // Get all assignments with their related staff members
        $assignments = Assignment::with('staff')->latest()->get();
        
        return view('supervisor.assignments.index', compact('staff', 'assignments'));
    }

    public function create()
    {
        $staff = Staff::all();
        return view('supervisor.assignments.create', compact('staff'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'staff_id' => 'required|exists:staff,id',
            'due_date' => 'required|date',
            'priority' => 'required|in:low,medium,high'
        ]);

        Assignment::create($validated);

        return redirect()->route('supervisor.assignments.index')
            ->with('success', 'Assignment created successfully.');
    }
}

}

}