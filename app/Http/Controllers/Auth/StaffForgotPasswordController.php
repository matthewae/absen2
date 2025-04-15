<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class StaffForgotPasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:staff');
    }

    /**
     * Display the form to request a password reset.
     *
     * @return \Illuminate\View\View
     */
    public function showLinkRequestForm()
    {
        return view('auth.staff.passwords.reset');
    }

    /**
     * Handle the incoming request to reset password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reset(Request $request)
    {
        $request->validate([
            'staff_id' => 'required',
            'password' => 'required|min:8|confirmed',
        ]);

        $staff = Staff::where('staff_id', $request->staff_id)->first();

        if (!$staff) {
            return back()
                ->withErrors(['staff_id' => 'Staff ID not found.'])
                ->withInput();
        }

        $staff->password = Hash::make($request->password);
        $staff->setRememberToken(Str::random(60));
        $staff->save();

        return redirect()->route('staff.login')
            ->with('status', 'Password has been reset successfully!');
    }
}