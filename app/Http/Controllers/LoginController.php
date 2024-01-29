<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        // dd($request->remember);

        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required'],
            // 'password_confirmation' => ['required', 'min:5'],
        ]);



        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            # code...
            return back()->with('mensaje', 'credenciales incorrectas');
        }

        return redirect()->route('post.index', ['user' => auth()->user()->username]);
        //return redirect()->route('post.index');
        //dd('Auntenticamdo...');
        // return view('auth.login');
    }
}
