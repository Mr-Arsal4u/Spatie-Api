<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class AuthorizePolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    // public function update(User $user, Post $post)
    // {
    //     return $user->id === $post->user_id
    //         ? Response::allow()
    //         : Response::denyWithStatus(404);
    // }
}
