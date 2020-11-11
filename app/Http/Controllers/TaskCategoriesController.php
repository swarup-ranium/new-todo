<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\TaskCategory;

class TaskCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categoryList = TaskCategory::all();
        return view('TaskCategory.index',compact('categoryList'));
    }

    public function changeStatus(Request $request) 
    {
        $taskCategory = TaskCategory::find($request->id);

        if($taskCategory->status == 0) 
        {
            $taskCategory->status = 1;
        } 
        else  
        {
            $taskCategory->status = 0;
        }

        $taskCategory->save();

        return redirect()->route('taskcategory.index')->with('success','Status Updated successfully!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('TaskCategory.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('taskcategory.create')
            ->withInput()
            ->withErrors($validator);
      }
      $taskCategory = new TaskCategory;
      $taskCategory->name = $request->name;
      $taskCategory->status = $request->status;
      $taskCategory->save();

      return redirect()->route('taskcategory.index')->with('success','Data Added successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $taskCategory = TaskCategory::find($id);

        return view('TaskCategory.edit',compact('taskCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:255'],
            'status' => ['required'],
        ]);

        if ($validator->fails()) {
            return redirect()->route('taskcategory.edit',$id)
            ->withInput()
            ->withErrors($validator);
      }

      $taskCategory = TaskCategory::find($id);
      $taskCategory->name = $request->name;
      $taskCategory->status = $request->status;
      $taskCategory->save();

      return redirect()->route('taskcategory.index')->with('success','Data Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $taskCategory = TaskCategory::find($id);
        $taskCategory->delete();

        return redirect()->route('taskcategory.index')->with('success', 'Data Deleted Successfully!!!!');
    }
}
