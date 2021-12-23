@extends('layouts.main')

@section('title', 'User Management - Create')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-rounded">
                <div class="card-body">
                    <h4 class="card-title card-title-dash">Create new user</h4>
                    <br>
                    <form action="{{ route('management.user.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label><i class="text-danger">(*)</i>E-Mail</label>
                            <input id="email" name="email" type="text" placeholder="Email" class="form-control" value="{{ old('email') }}">
                            @if ($errors->has('email'))
                                <span class="invalid-feedback" style="display: block" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label><i class="text-danger">(*)</i>Full Name</label>
                            <input id="name" name="name" type="text" placeholder="FullName" class="form-control" {{ old('name') }}>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" style="display: block" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Age</label>
                            <input name="age" id="age" type="number" class="form-control" placeholder="age" value="{{ old('age') }}">
                            @if ($errors->has('age'))
                                <span class="invalid-feedback" style="display: block" role="alert">
                                    <strong>{{ $errors->first('age') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>New password</label>
                            <input name="password" id="password" type="password" class="form-control">
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" style="display: block" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Confirm new password</label>
                            <input name="confirm_password" id="confirm_password" type="password"
                                class="form-control">
                            @if ($errors->has('confirm_password'))
                                <span class="invalid-feedback" style="display: block" role="alert">
                                    <strong>{{ $errors->first('confirm_password') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label><i class="text-danger">(*)</i>Roles</label>
                            <select name="role" class="form-control">
                                @foreach($roles as $role)
                                <option value="{{$role->id}}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('role'))
                            <span class="text-danger">{{ $errors->first('role') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <a href="{{ route('management.index') }}" class="btn btn-default btn-sm">Back</a>
                            <button type="submit" class="btn btn-info btn-sm">Create account</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
