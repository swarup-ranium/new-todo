<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\TaskCategory;
use App\Http\Requests\TaskStoreRequest;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = auth()->user();

        $query = $user->tasks();

        if (isset($request->task_category_id)) {
            $query->where('category_id', $request->task_category_id);
        }

        $tasks = $query->get();

        $categories = $user->taskCategories;

        return view('task.index', compact('tasks', 'categories'));
    }

    public function toggleCompleted(Task $task)
    {
        $task->is_complete = ! $task->is_complete;

        $task->save();

        return redirect()->route('task.index')->with('success', 'Status Updated successfully!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = auth()->user()->taskCategories;

        return view('task.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskStoreRequest $request)
    {
        $task = new Task;
        $task->user_id = Auth::user()->id;
        $task->name = $request->name;
        $task->category_id = $request->category_id;
        $task->is_complete = $request->is_complete;
        $task->save();

        return redirect()->route('task.index')->with('success', 'Data Added successfully!');
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
    public function edit(Task $task)
    {
        $categories = auth()->user()->taskCategories;

        return view('task.edit', compact('task', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskStoreRequest $request, Task $task)
    {
        $task->name = $request->name;
        $task->category_id = $request->category_id;
        $task->is_complete = $request->is_complete;
        $task->save();

        return redirect()->route('task.index')->with('success', 'Data Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('task.index')->with('success', 'Data Deleted Successfully!!!!');
    }
}
