<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TaskCategory;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TaskCategorySaveRequest;

class TaskCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = $request->user()->taskCategories;

        return view('task-category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('task-category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskCategorySaveRequest $request)
    {
        $taskCategory = new TaskCategory;
        $taskCategory->user_id = $request->user()->id;
        $taskCategory->name = $request->name;
        $taskCategory->save();

        return redirect()->route('taskCategory.index')
            ->with('success', 'Data Added successfully!');
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

    public function edit(TaskCategory $taskCategory)
    {
        return view('task-category.edit', compact('taskCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskCategorySaveRequest $request, TaskCategory $taskCategory)
    {
        $taskCategory->name = $request->name;
        $taskCategory->save();

        return redirect()->route('taskCategory.index')
            ->with('success', 'Data Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskCategory $taskCategory)
    {
        $taskCategory->delete();

        return redirect()->route('taskCategory.index')
            ->with('success', 'Data Deleted Successfully!!!!');
    }
}
