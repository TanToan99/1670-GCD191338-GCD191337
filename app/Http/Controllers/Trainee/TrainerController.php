<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TrainerController extends Controller
{
    public function index(){
        return view('trainee.trainee_course');
    }

    public function getDtRowData(Request $request){
        $id= $request->id;
        $courses = Courses::where('id',$id)->get();
		return Datatables::of($courses)
        ->make(true);
    }

}
