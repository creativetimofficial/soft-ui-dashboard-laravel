<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function loginSocial(string $provider): RedirectResponse
    {
        return Socialite::driver($provider)->redirect();
    }


    public function callbackSocial(Request $request, string $provider)
    {
        
        $response = Socialite::driver($provider)->user();
        $user = User::updateOrCreate([
            $provider.'_id' => $response->getId()
        ], [
            'name' => $response->getName() ?? $response->getNickname(),
            'email' => $response->getEmail(),
            'password' => Str::password(),
            
        ]);
     
        Auth::login($user);
     
        return redirect('/dashboard');





    }
}
