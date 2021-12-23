@extends('layouts.main')

@section('title', 'User Management - Edit')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-rounded">
                <div class="card-body">
                    <h4 class="card-title card-title-dash">Assign {{ $role }}: {{ $user->name }} - {{ $user->email }}</h4>
                    <br>
                    <form action="{{ route('management.user.assign',$user->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label><i class="text-danger">(*)</i>Course</label>
                            <select name="course_id" class="form-control">
                                @foreach($courses as $course)
                                <option value="{{$course->id}}">{{ $course->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <a href="{{ route('management.index') }}" class="btn btn-default btn-sm">Back</a>
                            <button type="submit" class="btn btn-info btn-sm">Assign</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
