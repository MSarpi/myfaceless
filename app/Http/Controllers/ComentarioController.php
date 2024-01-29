<?php

namespace App\Http\Controllers;

use App\Models\Comentario;
use App\Models\PostModel;
use App\Models\User;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    //
    public function store(Request $request, User $user, PostModel $post)
    {

        $this->validate($request, [
            'comentario' => ['required', 'max:255'],
        ]);


        Comentario::create([
            'user_id' => auth()->user()->id,
            'post_model_id' => $post->id,
            'comentario' => $request->comentario,
        ]);

        return back()->with('mensaje', 'comentario agregado');
        // dd('publicando nuevo comentario');
    }
}
