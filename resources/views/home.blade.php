@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @can('create posts')
                        <div class="card-header"><a href="{{ route('post.create') }}">Create Post</a></div>
                    @endcan

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @can('all posts list')
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Created At</th>
                                        <th>Author</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($posts->isEmpty())
                                        <tr>
                                            <b>
                                                <td colspan="4" class="text-center">No posts yet</td>
                                            </b>
                                        </tr>
                                    @else
                                        @foreach ($posts as $post)
                                            <tr style="border-color: green" class="hover-effect">
                                                <td>{{ $post->title }}</td>
                                                <td>{{ $post->created_at->diffForHumans() }}</td>
                                                <td>{{ $post->author->name }}</td>
                                                <td>
                                                    @can('edit all posts')
                                                        <a href="{{ route('post.edit', $post->id) }}"
                                                            class="btn btn-primary">Edit</a>
                                                    @elsecan('edit personal posts')
                                                        @if ($post->author->id === auth()->user()->id)
                                                            <a href="{{ route('post.edit', $post->id) }}"
                                                                class="btn btn-primary">Edit</a>
                                                        @endif
                                                    @endcan

                                                    @can('delete all posts')
                                                        <form method="POST" action="{{ route('post.delete', $post->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    @elsecan('delete personal posts')
                                                        @if ($post->author->id === auth()->user()->id)
                                                            <form method="POST" action="{{ route('post.delete', $post->id) }}">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-danger">Delete</button>
                                                            </form>
                                                        @endif
                                                    @endcan

                                                    @can('view any post')
                                                        <a href="{{ route('post.show', $post->id) }}"
                                                            class="btn btn-success">View</a>
                                                    @endcan
                                                </td>

                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>

                            </table>
                        @endcan
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
