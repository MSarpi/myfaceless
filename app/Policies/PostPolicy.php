<?php

namespace App\Policies;

use App\Models\PostModel;
use App\Models\User;
use Illuminate\Auth\Access\Response;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, PostModel $post) //: bool
    {
        //dd($user->id, $postModel->user_id); // Verifica los valores de id
        //return $user->id === $post->user_id;
    }
}
