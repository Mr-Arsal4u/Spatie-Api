<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Auth\Access\AuthorizationException;

class AuthorizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $postId = $request->route('id');
        $post = Post::find($postId);
        if (!Auth::user()->hasRole('superadmin') && $post->user_id !== Auth::user()->id) {
            abort(403, 'You are not authorized to perform this action.');
        }
        return $next($request);
    }
}
