@extends('layouts.app')

@section('content')
@include('common.errors')
<div class="container">
  <h2>Add Task</h2>
  <form action="{{route('task.store')}}" method="post">
  @csrf
    <div class="form-group">
      <label for="name">Task Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter Task Name" name="name">
    </div>
    <div class="form-group">
      <label for="pwd">Is Complete:</label>
      <select name="is_complete">
        <option selected disabled>Select</option>
        <option value="1">Yes</option>
        <option value="0">No</option>
      </select>
    </div>
    <button type="submit" class="btn btn-default">Add</button>
  </form>
</div>

@endsection