<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Categories;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class CategoryController extends Controller
{
    public function index(){
        return view('category.index');
    }

    
    public function getDtRowData(Request $request)
    {
        $cates = Categories::select(['id', 'name', 'description'])->get();
        return Datatables::of($cates)
            ->editColumn('name', function ($data) {
                return '<a href="'.route('category.courses',$data->id).'">'.$data->name.'</a>';
            })
            ->editColumn('action', function ($data) {
                return '
            <a href="' . route('category.edit', $data->id) . '"><button class="btn btn-warning mt-2">Edit</button>
            <a href="' . route('category.remove', $data->id) . '"><button class="btn btn-danger mt-2">Remove</button>';
            })
            ->rawColumns(['name','action'])
            ->make(true);
    }
    
    public function create(){
        return view('category.create');
    }
    
    public function store(CategoryRequest $request){
        $data = $request->except(["_token"]);
        if($category = Categories::create($data)){
            return redirect()->route('category.index')->with(['class' => 'success', 'message' => 'Create category success']);
        }
        else{
            return redirect()->back()->with(['class' => 'danger', 'message' => 'Error when create category']);
        }
    }

    public function edit($id)
    {
        $category = Categories::find($id);
        if ($category)
            return view('category.edit', [
                'category' => $category
            ]);
        return abort(404);
    }

    public function update(Request $request, $id)
    {
        if ($cate = Categories::find($id)) {
            $data = $request->only(['description']);
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
        $cate = Categories::find($id);
        if (!$cate)
            abort(404);
        if ($cate->delete())
            return redirect()->back()->with(['class' => 'success', 'message' => 'Remove success']);
        return redirect()->back()->with(['class' => 'danger', 'message' => 'Something wrong']);
    }

    public function courses($id)
    {
        $cate = Categories::find($id);
        return view('category.listCourseByCategory',[
            'category' => $cate
        ]);
    }
}
