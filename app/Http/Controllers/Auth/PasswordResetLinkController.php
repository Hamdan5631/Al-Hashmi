<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        $admin = Admin::where('email', $request->get('email'))->first();

        if (!$admin) {
            return back()->withErrors(['email' => 'Email does not exist']);
        }

        $token = Str::random(64);

        DB::table('password_reset_tokens')->insert([
            'email' => $request->get('email'),
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        Mail::send('pages.emails.password_reset_link', ['token' => $token],
            function ($message) use ($request) {
                $message->to($request->get('email'));
                $message->subject('Reset Password');
            });

        return back()->with('status', 'The password reset link has been sent to this email id');

    }
}
