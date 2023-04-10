<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UsersCrm;
use App\Models\User;


class SessionsController extends Controller
{
    public function create()
    {
        return view('session.login-session');
    }

    public function store()
    {
        $attributes = request()->validate([
            'email'=>'required|email',
            'password'=>'required' 
        ]);

        $userCrm = UsersCrm::select('first_name','last_name','role_id','password','email')->where('email', $attributes['email'])->where('password', md5($attributes['password']))->first();

        if(!$userCrm) return back()->withErrors(['email'=>'Usuário não encontrado.']);

        $attributesNew['email'] = $userCrm->email;
        $attributesNew['password'] = $attributes['password'];
        $attributesNew['name'] = $userCrm->first_name.' '.$userCrm->last_name;

        $user = User::where('email', $attributes['email'])->first();

        if($user) {
            try {
                $attributesNew['password'] = bcrypt($attributes['password']);
                $user->password = $attributesNew['password'];
                $user->save();
                Auth::login($user);
            } catch (\Throwable $th) {
                return back()->withErrors(['email'=>'Erro ao realizar o login, entre em contato com o grupo de suporte.']);
            }
        }else{
            try {
                $attributesNew['password'] = bcrypt($attributes['password']);
                $attributesNew['role_id'] = '3';
                $user = User::create($attributesNew);
                Auth::login($user); 
            } catch (\Throwable $th) {
                return back()->withErrors(['email'=>'Erro ao realizar primeiro login, entre em contato com o grupo de suporte.']);
            }
        }

        session()->regenerate();

        return redirect('dashboard')->with(['success'=>'Login realizado com sucesso.']);
    }
    
    public function destroy()
    {

        Auth::logout();

        return redirect('/login')->with(['success'=>'Logoff realizado.']);
    }
}
