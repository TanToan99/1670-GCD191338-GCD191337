<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Requests\CourseRequest;
use App\Models\Assign_trainee_course;
use App\Models\Assign_trainer_course;
use App\Models\Categories;
use App\Models\Courses;
use App\Models\User;
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
        if (isset($request->category_id)) {
            $courses = Courses::with('category')->where('category_id', $request->category_id)->get();
        } else {
            $courses = Courses::with('category')->get();
        }
        return Datatables::of($courses)
            ->editColumn('name', function ($data) {
                return '<a href="' . route('course.viewUsers', $data->id) . '">' . $data->name . '</a>';
            })
            ->editColumn('category', function ($data) {
                return '<a href="' . route('category.courses', $data->category->id) . '">' . $data->category->name . '</a>';
            })
            ->editColumn('action', function ($data) {
                return '
            <a href="' . route('course.edit', $data->id) . '"><button class="btn btn-warning mt-2">Edit</button>
            <a href="' . route('course.remove', $data->id) . '"><button class="btn btn-danger mt-2">Remove</button>';
            })
            ->rawColumns(['name', 'category', 'action'])
            ->make(true);
    }

    public function create()
    {
        $categories = Categories::all();
        return view('course.create', [
            'categories' => $categories
        ]);
    }

    public function store(CourseRequest $request)
    {
        $data = $request->except(["_token", "category"]);
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

    public function viewUserinCourse($course_id)
    {
        $course = Courses::find($course_id);
        if (!$course) {
            abort(404);
        }
        $trainer = Assign_trainer_course::where(
            'course_id',
            $course->id
        )->first();
        return view('course.viewUsersinCourse', [
            'course' => $course,
            'trainer' => ($trainer == null) ? "N/A" : $trainer->user->name
        ]);
    }


    public function getUsersRowData(Request $request)
    {
        $assignTrainee = Assign_trainee_course::with('user')->where('course_id', $request->course_id)->get();
        return Datatables::of($assignTrainee)
            ->editColumn('name', function ($data) {
                return $data->user->name;
            })
            ->editColumn('action', function ($data) {
                return '<a href="' . route('course.remove.user', [$data->course_id ,$data->user_id]) . '"><button class="btn btn-danger mt-2">Remove</button>';
            })
            ->make(true);
    }

    public function removeuserincourse($id, $user)
    {
        $user = User::find($user);
        if (!$user) abort(404);
        $course = Courses::find($id);
        if (!$course) abort(404);
        if (Assign_trainee_course::where([
            ['user_id', $user->id],
            ['course_id', $course->id]
        ])->first()->delete())
            return redirect()->back()->with(['class' => 'success', 'message' => 'Remove success']);
        return redirect()->back()->with(['class' => 'danger', 'message' => 'Something error']);
    }
}
