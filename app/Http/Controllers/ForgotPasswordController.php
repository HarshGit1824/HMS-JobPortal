<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class ForgotPasswordController extends Controller
{
    public function showLinkRequestForm()
    {
        return view('front.password.email');
    }

    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $email = $request->email;
        $token = Str::random(64);

        DB::table('password_resets')->updateOrInsert(
            ['email' => $email],
            ['token' => $token, 'created_at' => now()]
        );

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('SENDGRID_API_KEY'),
            'Content-Type' => 'application/json',
        ])->post('https://api.sendgrid.com/v3/mail/send', [
            'personalizations' => [[
                'to' => [['email' => $email]],
                'subject' => 'Reset Your Password',
            ]],
            'from' => [
                'email' => env('MAIL_FROM_ADDRESS'),
                'name' => env('MAIL_FROM_NAME'),
            ],
            'content' => [[
                'type' => 'text/html',
                'value' => 'Click the following link to reset your password: <a href="' . url('password/reset/' . $token) . '">Reset Password</a>',
            ]],
        ]);

        if ($response->successful()) {
            return back()->with('status', 'Password reset link sent to your email');
        } else {
            return back()->withErrors(['email' => 'Failed to send password reset email']);
        }
    }
}
