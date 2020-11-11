@extends('layouts.app')

@section('content')
@include('common.errors')
<div class="container">
  <h2>Task List</h2>
  <div class="container">
<table class="table table-hover">
    <thead>
    @if($taskList->count() > 0)
      <tr>
        <th>Task Id</th>
        <th>Task Name</th>
        <th>Is Complete</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    @endif
    </thead>
    <tbody>
        @if($taskList->count() > 0)
        @foreach($taskList as $task)
        <tr>
        <td>{{$task->id}}</td>
        <td>{{$task->name}}</td>
        <td> @if($task->is_complete == 0) <a href="{{route('task.changeStatus',['id' => $task->id])}}"><span class="btn btn-xs btn-danger"><i style="font-size:14px" class="fa">&#xf00d;</i></span></a> @else  <a href="{{route('task.changeStatus',['id' => $task->id])}}"><span class="btn btn-xs btn-success"><i style="font-size:14px" class="fa">&#xf00c;</i></span></a> @endif </td>
        <td><a href="{{route('task.edit',$task->id)}}" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a></td>
        <td>
        <form method="post" class="delete_form" action="{{route('task.destroy',$task->id)}}">
        {{csrf_field()}}
        <input type="hidden" name="_method" value="DELETE" />
        <button type="submit" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-trash"></span></button>
        </form>
        </td>
        </tr>
        @endforeach
        @else 
        <tr>No Data Found.</tr>
        @endif
    </tbody>
  </table>
  </div>
</div>
@endsection