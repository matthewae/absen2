<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:staff')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.staff.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'staff_id' => 'required',
            'password' => 'required|min:6'
        ]);

        $staff = Staff::where('staff_id', $request->staff_id)->first();

        if (!$staff) {
            return redirect()->back()
                ->withInput($request->only('staff_id', 'remember'))
                ->withErrors(['staff_id' => 'These credentials do not match our records.']);
        }

        if ($staff->password === $request->password) {
            Auth::guard('staff')->login($staff, $request->filled('remember'));
            $request->session()->regenerate();
            return redirect()->intended(route('staff.dashboard'));
        }

        return redirect()->back()
            ->withInput($request->only('staff_id', 'remember'))
            ->withErrors(['staff_id' => 'These credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('staff')->logout();
        return redirect()->route('staff.login');
    }
}