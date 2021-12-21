@extends('layouts.app')

@section('title','Login')

@section('content')
    <div class="col-md-8">
        <div class="mb-4">
            <h3>Login</h3>
            <p class="mb-4">Please login</p>
        </div>
        <form action="{{ route('login') }}" method="post">
            @csrf
            <div class="form-group first">
                <label for="username">Username</label>
                <input type="text" class="form-control" value="{{ old('email') }}" name="email" id="username" required
                    autocomplete="email" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group last mb-4">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required
                    autocomplete="current-password">

                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="d-flex mb-5 align-items-center">
                <label class="control control--checkbox mb-0"><span class="caption">Remember me</span>
                    <input type="checkbox" checked="checked" name="remember" />
                    <div class="control__indicator"></div>
                </label>
                <span class="ml-auto"><a href="#" class="forgot-pass">Forgot Password</a></span>
            </div>

            <input type="submit" value="Log In" class="btn text-white btn-block btn-primary">
            <span class="d-block text-left my-4 text-muted"> If you dont have account, <a href="{{ route('register') }}"> Register here</a></span>
        </form>
    </div>
@endsection
