<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserUpdateRequest;

class UserController extends Controller
{
    public function index(){
        return view('profile');
    }

    public function update(Request $request)
    {
        $user = auth()->user();
        $data = $request->except(["_token", "password", "confirm_password", "email"]);
        $data['password'] = isset($request['password']) ? bcrypt($request['password']) : $user->password;
        if ($user->update($data)) {
            return redirect()->back()->with(['class' => 'success', 'message' => 'Change information success']);
        } else {
            return redirect()->back()->with(['class' => 'danger', 'message' => 'Error, try lather']);
        }
        return abort(404);
    }
}
