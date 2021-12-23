<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Assign_trainee_course;
use App\Models\Assign_trainer_course;
use App\Models\Courses;
use App\Models\Roles;
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
                <a href="' . route('management.user.assign', $data->id) . '"><button class="btn btn-info mt-2">Assign</button>
                <a href="' . route('management.user.edit', $data->id) . '"><button class="btn btn-warning mt-2">Edit</button>
                <a href="' . route('management.user.remove', $data->id) . '"><button class="btn btn-danger mt-2">Remove</button>';
            })
            ->make(true);
    }

    public function create()
    {
        $roles = Roles::all();
        return view('management.create', [
            'roles' => $roles
        ]);
    }

    public function store(UserCreateRequest $request)
    {
        $data = $request->except(["_token", "confirm_password"]);
        $data["password"] = bcrypt($data["password"]);
        $role = Roles::find($request->role);
        if (($role->name == Roles::ROLE_STAFF || $role->name == Roles::ROLE_ADMIN) && auth()->user()->roles->first()->name == Roles::ROLE_STAFF)
            return redirect()->back()->with(['class' => 'danger', 'message' => 'You can not create admin or staff account']);
        if ($user = User::create($data)) {
            $user->roles()->sync([$request->role]);
            return redirect()->route('management.index')->with(['class' => 'success', 'message' => 'Create user success']);
        }
        return redirect()->back()->with(['class' => 'danger', 'message' => 'Error when create account']);
    }

    public function edit($id)
    {
        $roles = Roles::all();
        $user = User::find($id);
        if ($user)
            return view('management.edit', [
                'user' => $user,
                'roles' => $roles
            ]);
        return abort(404);
    }

    public function update(UserUpdateRequest $request, $id)
    {
        if ($user = User::find($id)) {
            if (($user->roles->first()->name == Roles::ROLE_STAFF || $user->roles->first()->name == Roles::ROLE_ADMIN) && auth()->user()->roles->first()->name == Roles::ROLE_STAFF)
                return redirect()->back()->with(['class' => 'danger', 'message' => 'You can not change information admin or staff account']);
            $data = $request->except(["_token", "password", "confirm_password", "email"]);
            $data['password'] = isset($request['password']) ? bcrypt($request['password']) : $user->password;

            if ($user->update($data)) {
                $user->roles()->sync([$request->role]);
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
        //dd($user->roles->first()->name);
        if (!$user)
            abort(404);
        if ($user->id == auth()->user()->id)
            return redirect()->back()->with(['class' => 'danger', 'message' => 'You can not remove your self']);
        if (($user->roles->first()->name == Roles::ROLE_STAFF || $user->roles->first()->name == Roles::ROLE_ADMIN) && auth()->user()->roles->first()->name == Roles::ROLE_STAFF)
            return redirect()->back()->with(['class' => 'danger', 'message' => 'You can not remove admin or staff account']);
        if ($user->delete())
            return redirect()->back()->with(['class' => 'success', 'message' => 'Remove success']);
        return redirect()->back()->with(['class' => 'danger', 'message' => 'Something wrong']);
    }

    public function assign($id){
        $user = User::find($id);
        $courses = Courses::all();
        if(!$user) abort(404);
        $roleName = $user->roles->first()->name;
        if($roleName == Roles::ROLE_STAFF || $roleName == Roles::ROLE_ADMIN){
            return redirect()->back()->with(['class' => 'danger', 'message' => 'Can not assign staff or admin to the course']);
        }
        return view('management.assign',[
            'user' => $user,
            'courses' => $courses,
            'role' => $roleName
        ]);
    }

    public function assignCourse(Request $request,$id){
        $user = User::find($id);
        if(!$user) abort(404);
        $roleName = $user->roles->first()->name;
        if($roleName == Roles::ROLE_STAFF || $roleName == Roles::ROLE_ADMIN){
            return redirect()->back()->with(['class' => 'danger', 'message' => 'Can not assign staff or admin to the course']);
        }
        $course = Courses::find($request->course_id);
        if(!$course) abort(404);
        if($roleName == Roles::ROLE_TRAINEE){
            if(Assign_trainee_course::where([
                ['user_id', $user->id],
                ['course_id', $course->id]])->first())
                return redirect()->back()->with(['class' => 'danger', 'message' => 'User already assign to this course']);
            if(Assign_trainee_course::create(['user_id' => $user->id,'course_id' => $course->id])){
                return redirect()->back()->with(['class' => 'success', 'message' => 'Assign success']);
            }
        }else{
            if(Assign_trainer_course::where([
                ['user_id', $user->id],
                ['course_id', $course->id]])->first())
                return redirect()->back()->with(['class' => 'danger', 'message' => 'User already assign to this course']);
            if(Assign_trainer_course::create(['user_id' => $user->id,'course_id' => $course->id])){
                return redirect()->back()->with(['class' => 'success', 'message' => 'Assign success']);
            }
        }
        return redirect()->back()->with(['class' => 'danger', 'message' => 'Something error']);
    }
}
