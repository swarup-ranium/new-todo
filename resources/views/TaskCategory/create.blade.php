@extends('layouts.app')

@section('content')
@include('common.errors')
<div class="container">
  <h2>Add Category</h2>
  <form action="{{route('taskcategory.store')}}" method="post">
  @csrf
    <div class="form-group">
      <label for="name">Category Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter Category Name" name="name">
    </div>
    <div class="form-group">
      <label for="status">Status:</label>
      <select name="status" id="status">
        <option selected disabled>Select</option>
        <option value="1">Active</option>
        <option value="0">Deactive</option>
      </select>
    </div>
    <button type="submit" class="btn btn-default">Add</button>
  </form>
</div>

@endsection