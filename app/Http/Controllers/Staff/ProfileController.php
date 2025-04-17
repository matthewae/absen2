<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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

        // Handle profile picture upload (store to DB as binary)
        if ($request->hasFile('profile_picture')) {
            $image = $request->file('profile_picture');
            $imageData = file_get_contents($image->getRealPath());
            $staff->profile_picture = $imageData;
        }

        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->phone_number = $request->phone;
        $staff->address = $request->address;

        // Handle password update
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
            $image = $request->file('photo');
            $imageData = file_get_contents($image->getRealPath());
            $staff->profile_picture = $imageData;
            $staff->save();
        }

        return redirect()->route('staff.profile')->with('success', 'Profile photo updated successfully.');
    }
}
