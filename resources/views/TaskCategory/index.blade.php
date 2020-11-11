@extends('layouts.app')

@section('content')
@include('common.errors')
<div class="container">
  <h2>Category List</h2>
  <div class="container">
<table class="table table-hover">
    <thead>
    @if($categoryList->count() > 0)
      <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Status</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    @endif
    </thead>
    <tbody>
        @if($categoryList->count() > 0)
        @foreach($categoryList as $cat)
        <tr>
        <td>{{$cat->id}}</td>
        <td>{{$cat->name}}</td>
        <td> @if($cat->status == 0) <a href="{{route('taskcategory-change-status',['id' => $cat->id])}}"><span class="btn btn-xs btn-danger"><i style="font-size:14px" class="fa">&#xf00d;</i></span></a> @else  <a href="{{route('taskcategory-change-status',['id' => $cat->id])}}"><span class="btn btn-xs btn-success"><i style="font-size:14px" class="fa">&#xf00c;</i></span></a> @endif </td>
        <td><a href="{{route('taskcategory.edit',$cat->id)}}" class="btn btn-xs btn-info"><span class="glyphicon glyphicon-edit"></span></a></td>
        <td>
        <form method="post" class="delete_form" action="{{route('taskcategory.destroy',$cat->id)}}">
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