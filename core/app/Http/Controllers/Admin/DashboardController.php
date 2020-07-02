<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function updatePasswordPage()
    {
        return view('admin.reset-password');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        $hashedPassword = Auth::user()->getAuthPassword();
        if (Hash::check($request->old_password, $hashedPassword)) {
            if (!Hash::check($request->password, $hashedPassword)) {
                $user = Admin::findOrFail(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Auth::logout();
                return redirect(route('admin.login'))->with('success', 'Admin Password successfully changed');
            } else {
                return back()->with("error", "New password can't be the same as old password !");
            }
        } else {
            return back()->with("error", "Current password does not matched!!!");
        }
    }
}
