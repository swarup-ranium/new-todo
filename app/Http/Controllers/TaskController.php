<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $taskList = Task::all();
        return view('Task.dashboard',compact('taskList'));
    }

    public function changeStatus(Request $request) {
        $task = Task::find($request->id);
        if($task->is_complete == 0) {
            $task->is_complete = 1;
        } else {
            $task->is_complete = 0;
        }
        $task->save();
        return redirect()->route('task.index')->with('success','Status Updated successfully!');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('Task.create');
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
            'name' => 'required|max:255',
            'is_complete' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->route('task.create')
            ->withInput()
            ->withErrors($validator);
      }
      $task = new Task;
      $task->name = $request->name;
      $task->is_complete = $request->is_complete;
      $task->save();
      return redirect()->route('task.index')->with('success','Task Added successfully!');
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
        $task = Task::find($id);
        return view('Task.edit',compact('task'));
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
            'name' => 'required|max:255',
            'is_complete' => 'required',
            ]);
            if ($validator->fails()) {
                return redirect()->route('task.edit',$id)
                ->withInput()
                ->withErrors($validator);
        }
        $task = Task::find($id);
        $task->name = $request->name;
        $task->is_complete = $request->is_complete;
        $task->save();
        return redirect()->route('task.index')->with('success','Task Updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return redirect()->route('task.index')->with('success', 'Data Deleted Successfully!!!!');
    }
}
