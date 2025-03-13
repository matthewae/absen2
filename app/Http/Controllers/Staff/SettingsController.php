<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function index()
    {
        return view('staff.settings');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        $staff = Auth::guard('staff')->user();

        if ($request->current_password !== $staff->password) {
            return back()->with('error', 'Current password is incorrect.');
        }

        $staff->password = $request->new_password;
        $staff->save();

        return back()->with('success', 'Password has been updated successfully.');
    }
}