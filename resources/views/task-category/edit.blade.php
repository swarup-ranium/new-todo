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
      <input type="text" class="form-control" id="name" placeholder="Enter Category Name" name="name"
        value="{{$taskCategory->name}}">
    </div>
    <button type="submit" class="btn btn-default">Update</button>
  </form>
</div>

@endsection