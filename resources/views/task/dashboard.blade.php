@extends('layouts.app')

@section('content')
@include('common.errors')
<div class="container">
  <div>
    <h2 style="display:inline-block;">Task List </h2>
    <form method="get" action="{{route('task.index')}}" style="display:inline;">
      <div class="pull-right">
        <label for="pwd">Filter:</label>

        <select onchange="event.preventDefault();this.closest('form').submit();" name="filter_id">
          <option>Select Category</option>
          <option value="">All</option>
          @foreach($categoryList as $catlist)
          <option value="{{$catlist->id}}">{{$catlist->name}}</option>
          @endforeach
        </select>
      </div>
    </form>
  </div>
  <div class="container">
    <table class="table table-hover">
      <thead>
        @if($taskList->count() > 0)
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Category</th>
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
          <td> @foreach($categoryList as $cat) @if($cat->id == $task->category_id) {{ $cat->name }} @endif @endforeach
          </td>
          <td> @if($task->is_complete == 0) <a href="{{route('task-change-status',['id' => $task->id])}}"><span
                class="btn btn-xs btn-danger"><i style="font-size:14px" class="fa">&#xf00d;</i></span></a> @else <a
              href="{{route('task-change-status',['id' => $task->id])}}"><span class="btn btn-xs btn-success"><i
                  style="font-size:14px" class="fa">&#xf00c;</i></span></a> @endif </td>
          <td><a href="{{route('task.edit',$task->id)}}" class="btn btn-xs btn-info"><span
                class="glyphicon glyphicon-edit"></span></a></td>
          <td>
            <form method="post" class="delete_form" action="{{route('task.destroy',$task->id)}}">
              {{csrf_field()}}
              <input type="hidden" name="_method" value="DELETE" />
              <button type="submit" class="btn btn-xs btn-danger"><span
                  class="glyphicon glyphicon-trash"></span></button>
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