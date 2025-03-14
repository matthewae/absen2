<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Supervisor;

class SupervisorSettingsController extends Controller
{
    public function showSettings()
    {
        return view('supervisor.settings');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $supervisor = Auth::guard('supervisor')->user();

        if (!Hash::check($request->current_password, $supervisor->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $supervisor->password = Hash::make($request->password);
        $supervisor->save();

        return back()->with('status', 'Password updated successfully!');
    }
}