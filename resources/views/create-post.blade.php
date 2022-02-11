@extends('layouts.frontend')
@section('title', 'Create Post')
@section('frontend-content')
<div id="manage-posts">
    <h4 class="pb-2 mb-3 border-bottom">Create Post</h4>
    <div class="card">
        <div class="card-body">
            <form action="/posts/store" method="POST">
                @csrf
                <div class="form-group">
                    <label for="title">Post Title</label>
                    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title"  value="{{old('title')}}" placeholder="Title" required>
                    @error('title')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control @error('content') is-invalid @enderror" name="content" id="content" rows="10" placeholder="Write your content . . .">{{old('content')}}</textarea>
                    @error('content')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="float-right">
                    <button class="btn btn-success">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
