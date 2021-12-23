@extends('layouts.main')

@section('title', 'User Profile')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-rounded">
                <div class="card-body">
                    <h4 class="card-title card-title-dash">User Profile</h4>
                    <br>
                    @php
                        $user = auth()->user();    
                    @endphp
                    <form action="{{ route('profile.update',$user->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label></i>E-Mail</label>
                            <input id="email" name="email" type="text" placeholder="Name" class="form-control"
                                readonly="readonly" value="{{ $user->email }}">
                        </div>

                        <div class="form-group">
                            <label></i>Full Name</label>
                            <input id="name" name="name" type="text" placeholder="FullName" class="form-control"
                                value="{{ $user->name }}">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" style="display: block" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Age</label>
                            <input name="age" id="age" type="number" class="form-control" placeholder="age" value="{{ $user->age }}">
                            @if ($errors->has('age'))
                                <span class="invalid-feedback" style="display: block" role="alert">
                                    <strong>{{ $errors->first('age') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>New password</label>
                            <input name="password" id="password" value="" type="password" class="form-control">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" style="display: block" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Confirm new password</label>
                            <input name="confirm_password" id="confirm_password" value="" type="password"
                                class="form-control">
                            @if ($errors->has('confirm_password'))
                                <span class="invalid-feedback" style="display: block" role="alert">
                                    <strong>{{ $errors->first('confirm_password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group"> 
                            <button type="submit" class="btn btn-info btn-sm">Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
