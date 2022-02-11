@extends('layouts.master')
@section('content')
<main class="container">
    <div class="row">
        <div class="col-md-4">
            <div>
                <div class="my-4 text-center">
                    <img src="https://ui-avatars.com/api/?rounded=true&name={{auth()->user()->name}}&background=random" alt="ui-avatar">
                    <h4 class="mt-1">{{auth()->user()->name}}</h4>
                </div>
                <div class="my-4 text-center">
                    <a href="/posts/create" class="btn btn-dark">Create post</a>
                </div>
            </div>
            <div class="list-group">
                <a href="/posts/all" class="list-group-item list-group-item-action {{(request()->is('posts/all')) ? 'active' : ''}} " aria-current="true">
                    All posts
                </a>
                <a href="/posts/manage" class="list-group-item list-group-item-action {{(request()->is('posts/manage', 'posts/create', 'posts/edit*')) ? 'active' : ''}} ">Manage posts</a>
                <a href="/posts/upload-using-csv" class="list-group-item list-group-item-action {{(request()->is('posts/upload-using-csv')) ? 'active' : ''}} " aria-current="true">
                    Upload posts using CSV
                </a>
                <a id="logout-btn" class="list-group-item list-group-item-action" 
                onclick="document.getElementById('logout-form').submit();">
                    Log out
                </a>
                <form id="logout-form" action="/logout" method="POST" hidden>
                    @csrf
                </form>
            </div>
        </div>
        <div class="col-md-8 my-4">
            @yield('frontend-content')
        </div>
    </div>
</main>
@endsection