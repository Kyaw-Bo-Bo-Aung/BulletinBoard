@extends('layouts.frontend')
@section('title', 'Edit Post')
@section('frontend-content')
<div id="manage-posts">
    <h4 class="pb-2 mb-3 border-bottom">Edit</h4>
    <div class="card">
        <div class="card-body">
            <form action="/posts/update/{{$my_post['id']}}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="title">Post Title</label>
                    <input class="form-control" type="text" value="{{$my_post['title']}}" name="title" placeholder="Title" required>
                </div>

                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea class="form-control" name="content" id="content" rows="10" placeholder="Write your content . . .">{{$my_post['content']}}</textarea>
                </div>

                <div class="float-right">
                    <button class="btn btn-success">Update post</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
