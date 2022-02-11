@extends('layouts.frontend')
@section('title', 'Manage Posts')
@section('frontend-content')
<div id="manage-posts">
    <h4 class="pb-2 mb-3 border-bottom">Manage posts</h4>
    {{-- <div class="row">
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
                            <div class="d-flex align-items-start">
                                <a href="/posts/edit/{{$post['id']}}" class="post-edit-btn"><i class="fas fa-edit ml-1 p-2 text-warning"></i></a>
                                <form action="/posts/delete/{{$post['id']}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="post-delete-btn"><i class="fas fa-trash ml-1 p-2 text-danger"></i></button>     
                                </form>
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
 
    </div> --}}

    <form id="delete_post_form" action="/posts/delete/@id" method="POST">
        @csrf
        @method('DELETE')
        
    </form>

    <form id="publish_post_form" action="/posts/publish/@id" method="POST">
        @csrf
        @method('PUT')
        
    </form>

    <table id="manage" class="table table-striped table-bordered w-100">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Content</th>
                <th>Created_at</th>
                <th>Published</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
</div>
@endsection

@section('scripts')
<script src="{{asset('assets/js/datatable.custom.js')}}"></script>
@endsection
