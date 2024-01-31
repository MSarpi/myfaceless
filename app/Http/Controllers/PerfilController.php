<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class PerfilController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {

        // dd('actualizando datos');

        $this->validate($request, [
            'username' => ['required', 'unique:users,username,' . auth()->user()->id, 'min:5', 'max:30'],
            'descripcion' => ['max:150'],
        ]);

        if ($request->avatar) {
            $archivo = $request->file('avatar');

            $manager = new ImageManager(new Driver());
            $img_unique_id = Str::uuid() . "." . $archivo->extension();
            $img = $manager->read($archivo);
            // $img->resize(1000, 1000);

            $imgPath = public_path('perfiles') . '/' . $img_unique_id;

            $img->save($imgPath);
        }

        $user = User::find(auth()->user()->id);
        $user->username = $request->username;
        $user->descripcion_perfil = $request->descripcion ?? '';
        $user->imagen_perfil = $img_unique_id ?? auth()->user()->imagen_perfil ?? '';

        $user->save();

        return redirect()->route('post.index', $user->username);
    }
}
