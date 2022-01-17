@extends('layouts.admin')

@section('content')
  <div class="mb-2 d-flex justify-content-end">
    <a href="{{route('village.create')}}" class="btn btn-success">New village</a>
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
      @foreach ($villages as $village)
      <tr>
        <td>{{ $village->id }}</td>
        <td>{{ $village->title }}</td>
        <td>{{ $village->slug }}</td>
        <td>-</td>
        <td><a href="{{route('village.edit', ['village' => $village->id])}}">Edit</a></td>
        <td>
          <form action="{{route('village.destroy', ['village' => $village->id])}}" method="post">
            @csrf
            @method('delete')
            <input type="submit" value="Delete">
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $villages->links('pagination.bootstrap') }}
@endsection