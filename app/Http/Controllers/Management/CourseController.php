<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CourseRequest;
use App\Models\Categories;
use App\Models\Courses;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CourseController extends Controller
{
    public function index()
    {
        return view('course.index');
    }


    public function getDtRowData(Request $request)
    {
        //dd($request->category_id);
        if(isset($request->category_id)){
            $courses = Courses::with('category')->where('category_id',$request->category_id)->get();
        }else{
            $courses = Courses::with('category')->get();
        }
        return Datatables::of($courses)
            ->editColumn('category', function ($data) {
                return '<a href="'.route('category.courses',$data->category->id).'">'.$data->category->name.'</a>';
            })
            ->editColumn('action', function ($data) {
                return '
            <a href="' . route('course.edit', $data->id) . '"><button class="btn btn-warning mt-2">Edit</button>
            <a href="' . route('course.remove', $data->id) . '"><button class="btn btn-danger mt-2">Remove</button>';
            })
            ->rawColumns(['category','action'])
            ->make(true);
    }

    public function create()
    {
        $categories = Categories::all();
        return view('course.create',[
            'categories' => $categories
        ]);
    }

    public function store(CourseRequest $request)
    {
        $data = $request->except(["_token","category"]);
        $data["category_id"] = $request->category;
        if ($course = Courses::create($data)) {
            return redirect()->route('course.index')->with(['class' => 'success', 'message' => 'Create course success']);
        } else {
            return redirect()->back()->with(['class' => 'danger', 'message' => 'Error when create course']);
        }
    }

    public function edit($id)
    {
        $course = Courses::find($id);
        $categories = Categories::all();
        if ($course)
            return view('course.edit', [
                'course' => $course,
                'categories' => $categories
            ]);
        return abort(404);
    }

    public function update(Request $request, $id)
    {
        //dd($request);
        if ($cate = Courses::find($id)) {
            $data = $request->only(['description']);
            $data["category_id"] = $request->category;
            if ($cate->update($data)) {
                return redirect()->back()->with(['class' => 'success', 'message' => 'Change information success']);
            } else {
                return redirect()->back()->with(['class' => 'danger', 'message' => 'Error, try lather']);
            }
        }
        return abort(404);
    }

    public function remove($id)
    {
        $course = Courses::find($id);
        if (!$course)
            abort(404);
        if ($course->delete())
            return redirect()->back()->with(['class' => 'success', 'message' => 'Remove success']);
        return redirect()->back()->with(['class' => 'danger', 'message' => 'Something wrong']);
    }
}
