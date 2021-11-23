<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class InfoUserController extends Controller
{

    public function create()
    {
        return view('laravel-examples/user-profile');
    }

    public function store(Request $request)
    {

        $attributes = request()->validate([
            'name' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users')->ignore(Auth::user()->id)],
            'phone'     => ['max:20'],
            'location' => ['max:70'],
            'about_me'    => ['max:150'],
        ]);
        
        User::where('id',Auth::user()->id)
        ->update([
            'name'    => $request->get('name'),
            'email' => $request->get('email'),
            'phone'     => $request->get('phone'),
            'location' => $request->get('location'),
            'about_me'    => $request->get("about_me"),
        ]);


        return redirect('/user-profile');
    }
}
