<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Service\PostService;
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
        $posts = $this->postsService->getAllposts();
        return view('home', compact('posts'));
    }

    public function show($id)
    {
        // $post = Post::findOrFail($id);
        $post = $this->postsService->getAllposts()->find($id);
        $this->postsService->notFound($post);
        return view('single-post', compact('post'));
    }
    public function create()
    {
        return view('create');
    }
    public function store(PostRequest $request)
    {
        $validated = $request->validated();
        $validated['user_id'] = auth()->id();
        Post::create($validated);
        return redirect()->route('post.index')->with('message', 'Post created successfully');
    }
    public function edit($id)
    {
        $post = $this->postsService->getAllposts()->find($id);
        // $request->authorize();
        $this->postsService->notFound($post);
        // $3x = 3;
        // $this->postsService->authorizePost($post);
        return view('edit', compact('post'));
    }
    public function update(PostRequest $request, $id)
    {
        $post = $this->postsService->getAllposts()->find($id);
        $validated = $request->validated();
        // $validated['user_id'] = auth()->id();
        // $this->postsService->authorizePost($post);
        $post->update($validated);
        return redirect()->route('post.index')->with('message', 'Post updated successfully');
    }
    public function delete($id)
    {
        // dd($request->all());     
        $post = $this->postsService->getAllposts()->find($id);
        $this->postsService->notFound($post);
        // $this->postsService->authorizePost($post);
        $post->delete();
        return redirect()->route('post.index')->with('message', 'Post deleted successfully');
    }
    public function ownPost()
    {
        $post = auth()->user()->posts;
        $this->postsService->notFound($post);
        return view('own-post', compact('post'));
    }
}
