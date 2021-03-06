<?php

namespace App\Http\Controllers\Trainee;

use App\Http\Controllers\Controller;
use App\Models\Assign_trainee_course;
use App\Models\Courses;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TraineeController extends Controller
{
    public function index(){
        return view('trainee.trainee_course');
    }

    public function getDtRowData(Request $request){
        $assignCourses = Assign_trainee_course::with('course')->where('user_id',auth()->user()->id)->get();
        // $courses = Courses::select(['id', 'name', 'description', 'category_id'])->get();
        //dd($assignCourses);
		return Datatables::of($assignCourses)
        ->editColumn('id', function($data){
            return $data->course->id;
        })
        ->editColumn('name', function($data){
            return '<a href="'. route('trainee.trainee_in_course',$data->course->id).'">'.$data->course->name.'</a>';
        })
        ->editColumn('description', function($data){
            return $data->course->description;
        })
        ->editColumn('category', function($data){ 
            return $data->course->category->name;
        })
        ->rawColumns(['name'])
        ->make(true);
    }

    public function trainee($id){
        $course = Courses::find($id);
        if(!$course) abort(404);
        return view('trainee.trainee_in_course',[
            'course' => $course
        ]);
    }

    public function getTneeRowData(Request $request){
        $course_id = $request->id;
        $assignTrainee = Assign_trainee_course::with('user')->where('course_id',$course_id)->get();
        // $courses = Courses::select(['id', 'name', 'description', 'category_id'])->get();
        //dd($assignCourses);
		return Datatables::of($assignTrainee)
        ->editColumn('id', function($data){
            return $data->user->id;
        })
        ->editColumn('email', function($data){
            return $data->user->email;
        })
        ->editColumn('name', function($data){
            return $data->user->name;
        })
        ->make(true);
    }
}
