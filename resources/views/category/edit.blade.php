@extends('layouts.main')

@section('title', 'Category Edit')

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-rounded">
                <div class="card-body">
                    <h4 class="card-title card-title-dash">Edit category: {{ $category->email }}</h4>
                    <br>
                    
                    <form action="{{ route('category.update',$category->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label><i class="text-danger">(*)</i>Name</label>
                            <input id="name" name="name" type="text" placeholder="Name" class="form-control" readonly="readonly"  value="{{ $category->name }}">
                        </div>

                        <div class="form-group">
                            <label><i class="text-danger">(*)</i>Description</label>
                            <textarea id="description" name="description" type="text" placeholder="Description" class="form-control" rows="4">{{ $category->description }}</textarea>
                            @if ($errors->has('description'))
                                <span class="invalid-feedback" style="display: block" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <a href="{{ route('management.index') }}" class="btn btn-default btn-sm">Back</a>
                            <button type="submit" class="btn btn-info btn-sm">Edit Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
