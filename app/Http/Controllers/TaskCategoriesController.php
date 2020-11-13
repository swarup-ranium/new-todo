<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\TaskCategory;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\TaskCategoryStoreRequest;

class TaskCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = auth()->user()->taskCategories;
        
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
    public function store(TaskCategoryStoreRequest $request)
    {
        $taskCategory = new TaskCategory;
        $taskCategory->user_id = Auth::user()->id;
        $taskCategory->name = $request->name;
        $taskCategory->save();

        return redirect()->route('taskcategory.index')->with('success', 'Data Added successfully!');
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

    public function edit(TaskCategory $taskcategory)
    {
        return view('task-category.edit', compact('taskcategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskCategoryStoreRequest $request, TaskCategory $taskcategory)
    {
        $taskcategory->name = $request->name;
        $taskcategory->save();

        return redirect()->route('taskcategory.index')->with('success', 'Data Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(TaskCategory $taskcategory)
    {
        $taskcategory->delete();

        return redirect()->route('taskcategory.index')->with('success', 'Data Deleted Successfully!!!!');
    }
}
