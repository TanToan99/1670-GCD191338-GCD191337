<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index()
    {
        return view('management.index');
    }

    public function getDtRowData(Request $request)
    {
        $users = User::select(['id', 'email', 'name', 'created_at'])->get();
        return Datatables::of($users)
            ->editColumn('role', function ($data) {
                if ($data->roles->first() == null)
                    return 'Trainee';
                return $data->roles->first()->name;
            })
            ->editColumn('action', function ($data) {
                return '
            <a href="' . route('management.user.edit', $data->id) . '"><button class="btn btn-warning mt-2">Edit</button>
            <a href="' . route('management.user.remove', $data->id) . '"><button class="btn btn-danger mt-2">Remove</button>';
            })
            ->make(true);
    }

    public function create(){
        return view('management.create');
    }
    
    public function store(UserRequest $request){
        $data = $request->except(["_token","confirm_password"]);
        $data["password"] = bcrypt($data["password"]);
        if(User::create($data)){
            return redirect()->back()->with(['class' => 'success', 'message' => 'Create user success']);
        }
        return redirect()->back()->with(['class' => 'danger', 'message' => 'Error when create account']);
    }

    public function edit($id)
    {
        $user = User::find($id);
        if ($user)
            return view('management.edit', [
                'user' => $user
            ]);
        return abort(404);
    }

    public function update(UserRequest $request, $id)
    {
        if ($user = User::find($id)) {
            $data = $request->except(["_token", "password", "confirm_password", "email"]);
            $data['password'] = isset($request['password']) ? bcrypt($request['password']) : $user->password;
            if ($user->update($data)) {
                return redirect()->back()->with(['class' => 'success', 'message' => 'Change information success']);
            } else {
                return redirect()->back()->with(['class' => 'danger', 'message' => 'Error, try lather']);
            }
        }
        return abort(404);
    }

    public function remove($id)
    {
        $user = User::find($id);
        if (!$user)
            abort(404);
        if ($user->id == auth()->user()->id)
            return redirect()->back()->with(['class' => 'danger', 'message' => 'You can not remove your self']);
        if ($user->delete())
            return redirect()->back()->with(['class' => 'success', 'message' => 'Remove success']);
        return redirect()->back()->with(['class' => 'danger', 'message' => 'Something wrong']);
    }
}
