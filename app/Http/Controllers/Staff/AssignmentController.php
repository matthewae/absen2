<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AssignmentController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_date' => 'required|date',
            'start_time' => 'required',
            'end_date' => 'required|date',
            'end_time' => 'required'
        ]);

        $startDateTime = Carbon::parse($request->start_date . ' ' . $request->start_time);
        $endDateTime = Carbon::parse($request->end_date . ' ' . $request->end_time);

        $assignment = Assignment::create([
            'title' => $request->title,
            'description' => $request->description,
            'start_datetime' => $startDateTime,
            'end_datetime' => $endDateTime,
            'staff_id' => auth()->id(),
            'status' => 'pending'
        ]);

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Assignment created successfully',
                'assignment' => $assignment
            ]);
        }

        return redirect()->route('staff.schedule')
            ->with('success', 'Assignment created successfully');
    }
}