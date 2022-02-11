@extends('layouts.frontend')
@section('title', 'All Posts')
@section('frontend-content')
<div id="all-posts">
    <h4 class="pb-2 mb-3 border-bottom">All posts</h4>
    <div class="row">
        @forelse ($posts as $post)
            <div class="col-12 my-2">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between w-100">
                            <div class="d-flex">
                                <img src="https://ui-avatars.com/api/?rounded=true&name={{$post['author']}}&background=random" alt="ui-avatar">
                                <div class="d-flex flex-column px-3">
                                    <span class="font-weight-bold post-username">{{$post['author']}}</span>
                                    <span class="text-muted text-sm post-duration">{{$post['created_at']}}</span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-2">
                            <h6>{{$post['title']}}</h6>
                            {{$post['content']}}
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="card w-100">
                <div class="card-body text-center text-muted">No post!</div>
            </div>
        @endforelse
    </div>
</div>
@endsection
