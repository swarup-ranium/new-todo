@extends('layouts.app')

@section('content')
@include('common.errors')
<div class="container">
  <h2>Edit Task</h2>
  <form action="{{route('task.update',$task->id)}}" method="post">
  @csrf
  @method('PUT')
    <div class="form-group">
      <label for="name">Task Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter Task Name" name="name" value = "{{$task->name}}">
    </div>
    <div class="form-group">
      <label for="pwd">Is Complete:</label>
      <select name="is_complete">
        <option selected disabled>Select</option>
        <option value="1" @if($task->is_complete == 1) selected @endif >Yes</option>
        <option value="0" @if($task->is_complete == 0) selected @endif >No</option>
      </select>
    </div>
    <button type="submit" class="btn btn-default">Update</button>
  </form>
</div>

@endsection