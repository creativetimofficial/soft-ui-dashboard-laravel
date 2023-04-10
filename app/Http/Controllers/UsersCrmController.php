<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\UsersCrm;

class UsersCrmController extends Controller
{
    public function returnUsersCrm(Request $request)
    {
        $clientes = UsersCrm::select('email','role_id','password')->get();
        if(!count($clientes)>0) return response()->json(['message' => 'error1'], 200);
        return response()->json(['message' => 'success','data'=>$clientes], 200);
    }
}