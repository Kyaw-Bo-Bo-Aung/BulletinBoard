@extends('layouts.master')
@section('title', 'Login')
@section('content')
<main class="d-flex flex-column justify-content-center align-items-center">
    <div class="container login-card card p-3">
        <div class="card-body">
            <div class="text-center">
                <img src="{{asset('assets/images/login.png')}}" alt="paper-with-pencil" class="img-fluid mb-4"
                    width="75">
            </div>
            <h4 class="text-center mb-4">Login</h4>
            <form action="/" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="password" value="{{old('email')}}" class="form-control @error('email') is-invalid @enderror" autocomplete="off" autofocus
                        required>
                    @error('email')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" autocomplete="off" required>
                    @error('password')
                    <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group text-center">
                    <button class="btn btn-primary">Sign in</button>
                </div>
            </form>
            <div class="mb-0">
                No account? Register <a href="/register">here</a>
            </div>
        </div>
    </div>
</main>
@endsection
