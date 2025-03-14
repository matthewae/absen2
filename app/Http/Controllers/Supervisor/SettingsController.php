<?php

namespace App\Http\Controllers\Supervisor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function showSettings()
    {
        return view('supervisor.settings');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $supervisor = Auth::guard('supervisor')->user();

        if (!Hash::check($request->current_password, $supervisor->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $supervisor->password = Hash::make($request->new_password);
        $supervisor->save();

        return back()->with('success', 'Password updated successfully.');
    }
}