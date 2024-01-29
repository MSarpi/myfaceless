<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegistroController extends Controller
{
    public function index()
    {
        return view('auth.registro');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'min:5', 'max:100'],
            'username' => ['required', 'unique:users', 'min:5', 'max:100'],
            'email' => ['required', 'unique:users', 'email'],
            'password' => ['required', 'confirmed', 'min:5'],
            'tac' => ['required'],
            // 'password_confirmation' => ['required', 'min:5'],
        ]);

        // $insert = array(
        //     "id_doc_tri" => $id_documento, 
        //     "numero_doc1" => "CI - ".$id_ci,
        //     "monto_car" => 0,
        //     "abono_factura" => $ci_abono_disponible, 
        //     "url_documento" => "-", 
        //     "nro_nota_credito" => "-", 
        //     "fecha_ingresada" => $request->fecha_ci_boleta,
        // );


        User::create([
            'name' => $request->name,
            'username' => Str::slug($request->username),
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'descripcion_perfil' => "",
            'imagen_perfil' => "",
            'termsandconditions' => 1,
        ]);

        // auth()->attempt([
        //     'email' => $request->email,
        //     'password' => $request->password,
        // ]);

        auth()->attempt($request->only('email', 'password'));

        //return redirect()->route('post.index');
        return redirect()->route('post.index', ['user' => auth()->user()->username]);
    }
}