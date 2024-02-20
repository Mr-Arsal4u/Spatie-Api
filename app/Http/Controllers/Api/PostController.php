<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use App\Service\PostService;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;


class PostController extends Controller
{

    protected $postsService;

    public function  __construct(PostService $post)
    {
        $this->postsService = $post;
    }
    public function index()
    {
        $post = $this->postsService->getAllposts();
        return response()->json([
            'json' => $post,
            'message' => "Bluetooth device connected successfully"
        ]);
    }

    public function show($id)
    {
        $post = $this->postsService->getAllposts()->find($id);
        $this->postsService->notFound($post);
        return response()->json([
            'json' => $post,
            'message' => "Bluetooth device connected successfully"
        ]);
    }
    public function create(PostRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        Post::create($validated);
        return response()->json([
            'message' => "Bluetooth device connected successfuly"
        ]);
    }
    public function update(PostRequest $request, $id)
    {
        $post = $this->postsService->getAllposts()->find($id);
        $this->postsService->notFound($post);
        $validated = $request->validated();
        // $validated['user_id'] = auth()->id();
        $post->update($validated);
        return response()->json([
            'message' => "Bluetooth device connected successfully"
        ]);
    }
    public function delete($id)
    {
        $post = $this->postsService->getAllposts()->find($id);
        $this->postsService->notFound($post);
        $post->delete();
        return response()->json([
            'message' => "Bluetooth device connected successfully"
        ]);
    }
}
