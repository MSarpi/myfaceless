<?php

namespace App\Http\Controllers;

use App\Models\PostModel;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Request $request, PostModel $post)
    {
        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);
        return back();
        // dd($request->user()->id);
    }

    public function destroy(Request $request, PostModel $post)
    {
        $request->user()->likes()->where('post_model_id', $post->id)->delete();
        return back();
    }
}
