<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Imagick\Driver;

class ImagenesController extends Controller
{
    //

    public function store(Request $request)
    {
        $archivo = $request->file('file');

        if ($archivo) {
            $manager = new ImageManager(new Driver());
            $img_unique_id = Str::uuid() . "." . $archivo->extension();
            $img = $manager->read($archivo);
            // $img->resize(1000, 1000);

            $imgPath = public_path('upload') . '/' . $img_unique_id;

            $img->save($imgPath);
        }

        return response()->json(['imagen' => $img_unique_id]);
    }
}