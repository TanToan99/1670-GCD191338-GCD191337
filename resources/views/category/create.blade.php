@extends('layouts.main')

@section('title', 'Category Management - Create')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-rounded">
                <div class="card-body">
                    <h4 class="card-title card-title-dash">Create New Category</h4>
                    <br>
                    <form action="{{ route('category.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label><i class="text-danger">(*)</i>Name</label>
                            <input id="name" name="name" type="text" placeholder="Name" class="form-control" value="{{ old('name') }}">
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" style="display: block" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label><i class="text-danger">(*)</i>Description</label>
                            <textarea id="description" name="description" value="{{ old('description') }}" type="text" placeholder="Description" class="form-control" value="{{ old('description') }}"></textarea>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" style="display: block" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <a href="{{ route('management.index') }}" class="btn btn-default btn-sm">Back</a>
                            <button type="submit" class="btn btn-info btn-sm">Create Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
