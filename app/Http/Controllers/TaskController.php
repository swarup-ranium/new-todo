<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Models\TaskCategory;
use App\Http\Resources\TaskResource;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\TaskSaveRequest;
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
            $query->where('task_category_id', $request->task_category_id);
        }

        $tasks = $query->get();
        $categories = $user->taskCategories;

        return view('task.index', compact('tasks', 'categories'));
    }

    public function fetchData(Request $request)
    {
        $user = auth()->user();
        $query = $user->tasks();

        if(isset($request->id)) {
            $query->where('task_category_id', $request->id);
        }

        $tasks = $query->get();
        $categories = $user->taskCategories;

        TaskResource::withoutWrapping();
        return TaskResource::collection(['categories'=> $categories,'tasks'=> $tasks]);
    }

    public function toggleCompleted(Task $task)
    {
        $this->authorize('update', $task);
        $task->is_complete = ! $task->is_complete;
        $task->save();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = auth()->user()->taskCategories;

        TaskResource::withoutWrapping();
        return TaskResource::collection($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TaskSaveRequest $request)
    {
        $task = new Task;
        $task->user_id = $request->user()->id;
        $task->name = $request->name;
        $task->task_category_id = $request->category_id;
        $task->save();

        TaskResource::withoutWrapping();
        return new TaskResource($task);
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
        $this->authorize('view', $task);

        $categories = auth()->user()->taskCategories;
        TaskResource::withoutWrapping();
        return TaskResource::collection(['task' => $task,'categories' => $categories]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TaskSaveRequest $request, Task $task)
    {
        $this->authorize('update', $task);

        $task->name = $request->name;
        $task->task_category_id = $request->category_id;
        $task->is_complete = $request->is_complete;
        $task->save();

        TaskResource::withoutWrapping();
        return new TaskResource($task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete', $task);
        $task->delete();

        TaskResource::withoutWrapping();
        return new TaskResource($task);
    }

}
