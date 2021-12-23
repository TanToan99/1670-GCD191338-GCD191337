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
        ->editColumn('category', function($data){ 
            return $data->course->category->name;
        })
        ->make(true);
    }

}
