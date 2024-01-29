<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        // dd(auth()->user());
        $posts = PostModel::where('user_id', $user->id)
            ->orderBy('created_at', 'desc') // Ordenar por fecha de creación en orden descendente
            ->paginate(20);

        return view(
            'dashboard',
            [
                'user' => $user,
                'posts' => $posts
            ]

        );
    }

    public function create()
    {
        return view('post.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            // 'titulo' => ['required', 'max:255'],
            // 'descripcion' => ['required'],
            'imagen' => ['required'],
        ]);

        $titulo = $request->titulo ? $request->titulo : "Sin Titulo";
        $descripcion = $request->descripcion ? $request->descripcion : "Sin descripción";

        PostModel::create([
            'titulo' => $titulo,
            'descripcion' => $descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('post.index', auth()->user()->username);
    }

    public function show(User $user, PostModel $post)
    {
        return view('post.show', [
            'post' => $post,
            'user' => $user,
        ]);
    }

    public function destroy(PostModel $post)
    {
        // dd('se destruyo', $post->id);
        if ($post->user_id === auth()->user()->id) {
            # code...
            $imagen_path = public_path('upload/' . $post->imagen);
            if (File::exists($imagen_path)) {
                unlink($imagen_path);
            }
            $post->delete();
            return redirect()->route('post.index', auth()->user()->username);
        }

        // $this->authorize('delete', $post);
        // $post->delete();
        // return redirect()->route('post.index', auth()->user()->username);
    }
}
