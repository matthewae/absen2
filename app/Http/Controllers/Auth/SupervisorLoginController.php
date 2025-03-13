<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Supervisor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SupervisorLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:supervisor')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.supervisor.login');
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'supervisor_id' => 'required',
            'password' => 'required|min:6'
        ]);

        $supervisor = Supervisor::where('supervisor_id', $request->supervisor_id)->first();

        if ($supervisor && $supervisor->password === $request->password) {
            Auth::guard('supervisor')->login($supervisor);
            if ($request->remember) {
                Auth::guard('supervisor')->viaRemember();
            }
            'supervisor_id' => $request->supervisor_id,
            'password' => $request->password
        ], $request->remember)) {
            return redirect()->intended(route('supervisor.dashboard'));
        }

        return redirect()->back()
            ->withInput($request->only('supervisor_id', 'remember'))
            ->withErrors(['supervisor_id' => 'These credentials do not match our records.']);
    }

    public function logout(Request $request)
    {
        Auth::guard('supervisor')->logout();
        return redirect()->route('supervisor.login');
    }
}