@extends('layouts.admin')

@section('content')
  <div class="mb-2 d-flex justify-content-end">
    <a href="{{route('post.create')}}" class="btn btn-success">New post</a>
  </div>
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Status</th>
        <th>Region</th>
        <th>City</th>
        <th>Village</th>
        <th>User</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($posts as $post)
      <tr>
        <td>{{ $post->id }}</td>
				<td><a href="{{$post->path()}}">{{ $post->title }}</a></td>
        <td>{{ $post->published ? 'Published' : 'Pending' }}</td>
        <td>{{ $post->region->title }}</td>
        <td>{{ $post->city ? $post->city->title : '-' }}</td>
        <td>{{ $post->village ? $post->village->title : '-' }}</td>
        <td>{{ $post->user->name }}</td>
        <td><a href="{{route('post.edit', ['post' => $post->id])}}">Edit</a></td>
        <td>
          <form action="{{route('post.destroy', ['post' => $post->id])}}" method="post">
            @csrf
            @method('delete')
            <input onclick="return confirm('Are you sure?')" type="submit" value="Delete">
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $posts->links('pagination.bootstrap') }}
@endsection