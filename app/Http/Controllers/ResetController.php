<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\View;

class ResetController extends Controller
{
    public function create()
    {
        return view('session/reset-password/sendEmail');
        
    }

    public function sendEmail(Request $request)
    {
        if(env('IS_DEMO'))
        {
            return redirect()->back()->withErrors(['msg2' => 'You are in a demo version, you can\'t recover your password.']);
        }
        else{
            $request->validate(['email' => 'required|email']);

            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status === Password::RESET_LINK_SENT
                        ? back()->with(['success' => __($status)])
                        : back()->withErrors(['email' => __($status)]);
        }
    }

    public function resetPass($token)
    {
        return view('session/reset-password/resetPassword', ['token' => $token]);
    }
}
