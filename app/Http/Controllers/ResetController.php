<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\View;

class ResetController extends Controller
{
    public function create()
    {
        $isDemoNotification = false;
        return view('session/reset-password/sendEmail')->with('isDemoNotification',$isDemoNotification);
        
    }

    public function sendEmail(Request $request)
    {
        if(env('IS_DEMO'))
        {
            $isDemoNotification = true;
            return View::make('session/reset-password/sendEmail')->with('isDemoNotification',$isDemoNotification);
        }
        else{
            $request->validate(['email' => 'required|email']);

            $status = Password::sendResetLink(
                $request->only('email')
            );

            return $status === Password::RESET_LINK_SENT
                        ? back()->with(['status' => __($status)])
                        : back()->withErrors(['email' => __($status)]);
        }
    }

    public function resetPass($token)
    {
        return view('session/reset-password/resetPassword', ['token' => $token]);
    }
}
