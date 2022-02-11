@extends('layouts.master')
@section('title', 'Register')
@section('content')
<main class="d-flex flex-column justify-content-center align-items-center">
    <div class="container login-card card p-3">
        <div class="card-body">
            <div class="text-center">
                <img src="{{asset('assets/images/login.png')}}" alt="paper-with-pencil" class="img-fluid mb-4"
                    width="75">
            </div>
            <h4 class="text-center mb-4">Register</h4>
            <form action="/register" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Username</label>
                    <input type="text" name="name" id="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror" autocomplete="off" autofocus
                        required>
                    @error('name')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" autocomplete="off" autofocus
                        required>
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" autocomplete="off" required>
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password_confirmation">Confirm password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" autocomplete="off" required>
                    @error('password_confirmation')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group text-center">
                    <button class="btn btn-primary">Sign up</button>
                </div>
            </form>
            <div class="mb-0">
                If you already have account, please <a href="/">log in.</a>
            </div>
        </div>
    </div>
</main>
@endsection