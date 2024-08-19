<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request, $token)
    {
        return view('front.password.reset', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $tokenData = DB::table('password_resets')->where('token', $request->token)->first();

        if (!$tokenData) {
            return back()->withErrors(['email' => 'Invalid token']);
        }

        $user = DB::table('users')->where('email', $request->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email not found']);
        }

        DB::table('users')->where('email', $request->email)->update(['password' => Hash::make($request->password)]);
        DB::table('password_resets')->where('email', $request->email)->delete();

        return redirect()->route('account.login')->with('status', 'Password reset successful');
    }
}
