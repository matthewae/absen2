<?php

namespace App\Http\Controllers\Supervisor;

use App\Models\Supervisor;
use App\Models\Assignment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::with(['staff'])->latest()->paginate(10);
        return view('supervisor.assignments.index', compact('assignments'));
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
}