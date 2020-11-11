@extends('layouts.app')

@section('content')
@include('common.errors')
<div class="container">
  <h2>Edit Category</h2>
  <form action="{{route('taskcategory.update',$taskCategory->id)}}" method="post">
  @csrf
  @method('PUT')
    <div class="form-group">
      <label for="name">Category Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter Category Name" name="name" value="{{$taskCategory->name}}">
    </div>
    <div class="form-group">
      <label for="status">Status:</label>
      <select name="status" id="status">
        <option selected disabled>Select</option>
        <option value="1" @if($taskCategory->status == 1) selected @endif >Active</option>
        <option value="0" @if($taskCategory->status == 0) selected @endif >Deactive</option>
      </select>
    </div>
    <button type="submit" class="btn btn-default">Update</button>
  </form>
</div>

@endsection