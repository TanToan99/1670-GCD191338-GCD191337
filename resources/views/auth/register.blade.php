@extends('layouts.app')

@section('title','Register')

@section('content')

<div class="col-md-8">
        <div class="mb-4">
            <h3>Register</h3>
            <p class="mb-4">Register here</p>
        </div>
        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="form-group first mb-4">
                <label for="name">Name</label>
                <input type="text" class="form-control" name="name" id="name" required autocomplete="current-name" autofocus>
            </div>
            <div class="form-group first mb-4">
                <label for="email">Email</label>
                <input type="text" class="form-control" value="{{ old('email') }}" name="email" id="email" required
                    autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group first mb-4">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group first mb-4">
                <label for="password">Password Confirm</label>
                <input type="password" class="form-control" id="password" name="password_confirmation" required autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <input type="submit" value="Register" class="btn text-white btn-block btn-primary">
            <span class="d-block text-left my-4 text-muted"> If you already have an account, <a href="{{ route('login') }}"> Login here</a></span>
        </form>
    </div>
@endsection

