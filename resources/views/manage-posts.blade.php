@extends('layouts.frontend')
@section('title', 'Manage Posts')
@section('frontend-content')
<div id="manage-posts">
    <h4 class="pb-2 mb-3 border-bottom">Manage posts</h4>

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
