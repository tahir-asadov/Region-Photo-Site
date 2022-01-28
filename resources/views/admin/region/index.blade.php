@extends('layouts.admin')

@section('content')
<div class="mb-2 d-flex justify-content-end">
  <a href="{{route('region.create')}}" class="btn btn-success">New region</a>
</div>
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Slug</th>
        <th>Post count</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($regions as $region)
      <tr>
        <td>{{$region->id}}</td>
        <td><a href="{{route('public.region', ['region' => $region->slug])}}">{{$region->title}}</a></td>
        <td>{{$region->slug}}</td>
        <td>-</td>
        <td><a href="{{route('region.edit', ['region' => $region->id])}}">Edit</a></td>
        <td>
          <form action="{{route('region.destroy', ['region' => $region->id])}}" method="post">
            @csrf
            @method('delete')
            <input onclick="return confirm('Are you sure?')" type="submit" value="Delete">
          </form>
        </td>
      </tr>
          
      @endforeach
    </tbody>
  </table>
  {{ $regions->links('pagination.bootstrap') }}
@endsection