<?php

namespace App\Service;

use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PostService
{
    public function getAllposts()
    {
        $posts = Post::with('comments')->latest()->get();

        return $posts;
    }

    // public function authorizePost($post)
    // {
    //     if (!Auth::user()->hasRole('superadmin') && $post->user_id !== Auth::user()->id) {
    //         abort(403, 'You are not authorized to perform this action.');
    //     }
    // }

    public function notFound($post)
    {
        if (!$post) {
            throw new ModelNotFoundException('Post Not Found');
        }
    }
}
