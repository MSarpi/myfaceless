<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LogoutController extends Controller
{
    //
    public function store(Request $request)
    {
        // dd('cerraste sesion');
        auth()->logout();
        return redirect()->route('login');
    }
}
