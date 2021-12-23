<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use App\Models\Courses;
use App\Models\Assign_trainer_course;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class TrainerController extends Controller
{
    public function index(){
        return view('trainer.trainer_course');
    }

    public function getDtRowData(Request $request){
        $assignCourses = Assign_trainer_course::with('course')->where('user_id',auth()->user()->id)->get();
        // $courses = Courses::select(['id', 'name', 'description', 'category_id'])->get();
        //dd($assignCourses);
		return Datatables::of($assignCourses)
        ->editColumn('id', function($data){
            return $data->course->id;
        })
        ->editColumn('name', function($data){
            return '<a href="'. route('trainer.trainer_in_course',$data->course->id).'">'.$data->course->name.'</a>';
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

    public function trainer($id){
        $course = Courses::find($id);
        if(!$course) abort(404);
        return view('trainer.trainer_in_course',[
            'course' => $course
        ]);
    }

    public function getTnerRowData(Request $request){
        $course_id = $request->id;
        $assignTrainer = Assign_trainer_course::with('user')->where('course_id',$course_id)->get();
        // $courses = Courses::select(['id', 'name', 'description', 'category_id'])->get();
        //dd($assignCourses);
		return Datatables::of($assignTrainer)
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
