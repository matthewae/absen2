<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $staff = Auth::user();
        return view('staff.profile', compact('staff'));
    }

    public function update(Request $request)
    {
        $staff = Auth::user();
        
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:staff,email,' . $staff->id,
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('profile_picture')) {
            if ($staff->profile_picture) {
                Storage::delete('public/profile_pictures/' . $staff->profile_picture);
            }
            
            $fileName = time() . '.' . $request->profile_picture->extension();
            $request->profile_picture->storeAs('public/profile_pictures', $fileName);
            $staff->profile_picture = $fileName;
        }

        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->phone = $request->phone;
        $staff->address = $request->address;
        
        if ($request->filled('current_password') && $request->filled('new_password')) {
            $request->validate([
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:8|confirmed'
            ]);

            if (!Hash::check($request->current_password, $staff->password)) {
                return back()->withErrors(['current_password' => 'The current password is incorrect.']);
            }

            $staff->password = Hash::make($request->new_password);
        }

        $staff->save();

        return redirect()->route('staff.profile')->with('success', 'Profile updated successfully.');
    }

    public function updatePhoto(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $staff = Auth::user();

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($staff->photo_url) {
                Storage::delete('public/staff_photos/' . basename($staff->photo_url));
            }
            
            // Store new photo
            $fileName = time() . '_' . $staff->id . '.' . $request->photo->extension();
            $request->photo->storeAs('public/staff_photos', $fileName);
            
            // Update staff photo URL
            $staff->photo_url = Storage::url('staff_photos/' . $fileName);
            $staff->save();
        }

        return redirect()->route('staff.profile')->with('success', 'Profile photo updated successfully.');
    }
}