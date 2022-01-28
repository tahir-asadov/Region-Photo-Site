@extends('layouts.admin')

@section('content')
<div class="mb-2 d-flex justify-content-end">
  <a href="{{route('city.create')}}" class="btn btn-success">New city</a>
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
      @foreach ($cities as $city)
      <tr>
        <td>{{ $city->id }}</td>
        <td><a href="{{route('public.city', ['city' => $city->slug])}}">{{ $city->title }}</a></td>
        <td>{{ $city->slug }}</td>
        <td>-</td>
        <td><a href="{{route('city.edit', ['city' => $city->id])}}">Edit</a></td>
        <td>
          <form action="{{route('city.destroy', ['city' => $city->id])}}" method="post">
            @csrf
            @method('delete')
            <input onclick="return confirm('Are you sure?')" type="submit" value="Delete">
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $cities->links('pagination.bootstrap') }}
@endsection