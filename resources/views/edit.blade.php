@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header"><a href="{{ route('post.index') }}">All Posts</a></div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('post.update', $post->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="title">{{ __('Title') }}</label>
                                <input value="{{ $post->title }}" id="title" type="text"
                                    class="form-control @error('title') is-invalid @enderror" name="title"
                                    value="{{ old('title') }}" required autofocus>
                                @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <input type="hidden" value="{{ $post->id }}">
                            <div class="form-group">
                                <label for="body">{{ __('Body') }}</label>
                                <textarea id="body" class="form-control @error('body') is-invalid @enderror" name="body" required>{{ old('body', $post->body) }}</textarea>
                                @error('body')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mt-2">{{ __('Update Post') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
