@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="border-color: orange;">
                    <div class="card-header">
                        Watch Post

                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Title: "{{ $post->title }}"</h5>
                        <p class="card-text">{{ $post->body }}</p>
                        <p class="card-text"><small class="text-muted">Author: {{ $post->author->name }}</small></p>
                        <p class="card-text"><small class="text-muted">Created:
                                {{ $post->created_at->format('F d, Y h:ia') }}</small></p>
                    </div>
                </div>
                @can('comment on posts')
                    <div class="card mt-4">
                        <div class="card-header">Add Comment</div>
                        <div class="card-body">
                            <form action="{{ route('comment.create', $post->id) }}" method="POST">
                                @csrf
                                {{-- <input type="hidden" name="post_id" value="{{ $post->id }}"> --}}
                                <div class="form-group">
                                    <label for="comment">Comment</label>
                                    <textarea class="form-control" id="comment" name="body" rows="3" required></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                @endcan


                <div class="card-body mt-5">
                    @foreach ($post->comments as $comment)
                        <div class="card mb-3" style="border-color: red">
                            <div class="card-body">
                                <p class="card-text">{{ $comment->body }}</p>
                                <p class="card-text">By: <b>{{ $comment->author->name }} </b></p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
