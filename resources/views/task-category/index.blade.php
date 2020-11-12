@extends('layouts.app')

@section('content')
@include('common.errors')
<div class="container">
  <h2>Category List</h2>
  <div class="container">
    <table class="table table-hover">
      <thead>
        @if($categories->count() > 0)
        <tr>
          <th>Id</th>
          <th>Name</th>
          <th>Edit</th>
          <th>Delete</th>
        </tr>
        @endif
      </thead>
      <tbody>
        @if($categories->count() > 0)
        @foreach($categories as $cat)
        <tr>
          <td>{{$cat->id}}</td>
          <td>{{$cat->name}}</td>
          <td><a href="{{route('taskcategory.edit',$cat->id)}}" class="btn btn-xs btn-info"><span
                class="glyphicon glyphicon-edit"></span></a></td>
          <td>
            <form method="post" class="delete_form" action="{{route('taskcategory.destroy',$cat->id)}}">
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