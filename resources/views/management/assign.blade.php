@extends('layouts.main')

@section('title', 'User Management - Assign course')

@section('custom-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" />
    <style>
        .pagination a {
            color: black;
            float: left;
            padding: 8px 16px;
            text-decoration: none;
            transition: background-color .3s;
            border: 1px solid #ddd;
            margin: 0 4px;
        }

        .pagination li.active>a {
            background-color: blue;
            color: white;
            border: 1px solid #blue;
        }

        .pagination a:hover:not(.active) {
            background-color: #ddd;
            color: black;
        }

    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card card-rounded">
                <div class="card-body">
                    <h4 class="card-title card-title-dash">Assign {{ $role }}: {{ $user->name }} - {{ $user->email }}</h4>
                    <br>
                    <form action="{{ route('management.user.assignCourse',$user->id) }}" method="POST">
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
                <div class="card-body">
                    <h4 class="card-title card-title-dash">List course:</h4>
                    <br>
                    <table id="users-table" class="table table-condensed col-12">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom-js')
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    paginate: {
                        previous: "<",
                        next: ">"
                    }
                },
                ajax: {
                    "url": '{{ url('/management/user/course/dt-row-data') }}',
                    "data": {
                        'user_id': '{{ $user->id }}'
                    }
                },
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'description',
                        name: 'description',
                    },
                    {
                        data: 'category',
                        name: 'category',
                    },
                    {
                        data: 'action',
                        name: 'action',
                    },
                ]
            });
            $('#users-table_wrapper').removeClass('form-inline');
        });
    </script>
@endsection
