<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function __invoke()
    {

        //dd(auth()->user()->following->pluck('id')->toArray()); //con esto se ve a quien seguimos y quien nos sigue para empezar a ver su contenido y pluck indica el campo que queremos rescatar si lo sacamos moistrara toda la informacion
        $idUsers = auth()->user()->following->pluck('id')->toArray();
        $user = User::whereIn('id', $idUsers)->orderBy('created_at', 'desc')->paginate(20);
        $posts = PostModel::whereIn('user_id', $idUsers)->orderBy('created_at', 'desc')->paginate(20);

        return view(
            'home',
            ['posts' => $posts] //con esto creamos una variable que le entrega al usuario autenticado todos los post de los usuarios al cual sigue
        );
    }
}