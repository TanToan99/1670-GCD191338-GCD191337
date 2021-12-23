@extends('layouts.main')

@section('title', 'Course Edit')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-rounded">
                <div class="card-body">
                    <h4 class="card-title card-title-dash">Edit course: {{ $course->name }}</h4>
                    <br>
                    
                    <form action="{{ route('course.update',$course->id ) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label><i class="text-danger">(*)</i>Name</label>
                            <input id="name" name="name" type="text" placeholder="Name" class="form-control" value="{{ $course->name }}" readonly>
                            @if ($errors->has('name'))
                                <span class="invalid-feedback" style="display: block" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label><i class="text-danger">(*)</i>Description</label>
                            <textarea id="description" name="description" type="text" placeholder="Description" class="form-control">{{ $course->description }}"</textarea>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" style="display: block" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label><i class="text-danger">(*)</i>Category</label>
                            <select name="category" class="form-control">
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('category'))
                            <span class="text-danger">{{ $errors->first('category') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <a href="{{ route('management.index') }}" class="btn btn-default btn-sm">Back</a>
                            <button type="submit" class="btn btn-info btn-sm">Edit course</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
