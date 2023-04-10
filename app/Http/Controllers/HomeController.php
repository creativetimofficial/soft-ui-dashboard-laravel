<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Card;


class HomeController extends Controller
{
    public function home()
    {
        return redirect('dashboard');
    }
}
