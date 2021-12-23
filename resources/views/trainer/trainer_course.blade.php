@extends('layouts.main')

@section('title', 'Trainer Course')

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

        .pagination li.active>a{
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
            <br>
            <table id="courses-table" class="table table-condensed col-12">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Course</th>
                        <th>Description</th>
                        <th>Category</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('custom-js')
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#courses-table').DataTable({
                processing: true,
                serverSide: true,
                language: {
                    paginate: {
                        previous: "<",
                        next: ">"
                    }
                },
                ajax: '{{ url('/trainer/dt-row-data') }}',
                columns: [{
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name',
                    },
                    {
                        data: 'description',
                        name: 'description'
                    },
                    {
                        data: 'category',
                        name: 'category',
                    },
                ]
            });
        });
    </script>
@endsection
