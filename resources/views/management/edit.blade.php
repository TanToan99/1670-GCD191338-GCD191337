@extends('layouts.main')

@section('title', 'User Management - Edit')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-rounded">
                <div class="card-body">
                    <h4 class="card-title card-title-dash">Edit user: {{ $user->email }}</h4>
                    <br>
                    <form action="{{ route('management.user.update',$user->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label><i class="text-danger">(*)</i>E-Mail</label>
                            <input id="email" name="email" type="text" placeholder="Name" class="form-control"
                                readonly="readonly" value="{{ $user->email }}">
                        </div>

                        <div class="form-group">
                            <label><i class="text-danger">(*)</i>Full Name</label>
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
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>New password</label>
                            <input name="password" id="password" value="" type="password" class="form-control">
                        </div>
                        <div class="form-group">
                            <label>Confirm new password</label>
                            <input name="confirm_password" id="confirm_password" value="" type="password"
                                class="form-control">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" style="display: block" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <a href="{{ route('management.index') }}" class="btn btn-default btn-sm">Back</a>
                            <button type="submit" class="btn btn-info btn-sm">Save Change</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
