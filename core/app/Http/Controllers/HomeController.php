<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function updatePasswordPage()
    {
        return view('reset-password');
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
                $user = User::findOrFail(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Auth::logout();
                return redirect(route('login'))->with('success', 'User Password successfully changed');
            } else {
                return back()->with("error", "New password can't be the same as old password !");
            }
        } else {
            return back()->with("error", "Current password does not matched!!!");
        }
    }
}
