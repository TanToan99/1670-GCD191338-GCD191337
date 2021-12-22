<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(){
        return view('management.index');
    }

    public function getDtRowData(Request $request){
        $users = User::select(['id', 'email', 'name', 'created_at'])->get();
		return Datatables::of($users)
        ->editColumn('role', function($data){
            return $data->roles->first()->name;
        })
        ->editColumn('action',function($data){
            return '<button class="btn btn-warning  me-0">Edit</button>';
        })
        ->make(true);
    }
}
