<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function create(Request $request, $id)
    {
        // dd($request->all());
        $request->validate([
            'body' => 'required',
        ]);
        // dd($post);
        Post::find($id)->comments()->create([
            'user_id' => $request->user()->id,
            'body' => $request->body,
        ]);
        return back()->with('message', 'Comment created successfully');
    }
    public function createApi(Request $request, $id)
    {

        $request->validate([
            'body' => 'required',
        ]);

        Post::find($id)->comments()->create([
            'user_id' => $request->user()->id,
            'body' => $request->body,
        ]);
        return response()->json([
            'message' => "Comment created successfully"
        ]);
    }
}
