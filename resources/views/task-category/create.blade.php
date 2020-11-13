@extends('layouts.app')

@section('content')
@include('common.errors')
<div class="container">
  <h2>Add Category</h2>
  <form action="{{route('taskCategory.store')}}" method="post">
    @csrf
    <div class="form-group">
      <label for="name">Category Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter Category Name" name="name">
    </div>
    <button type="submit" class="btn btn-default">Add</button>
  </form>
</div>

@endsection