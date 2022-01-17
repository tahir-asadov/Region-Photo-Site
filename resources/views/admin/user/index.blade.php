@extends('layouts.admin')

@section('title', 'Users')

@section('sidebar')@endsection

@section('content')
  <div class="mb-2 d-flex justify-content-end">
    <a href="{{route('user.create')}}" class="btn btn-success">New user</a>
  </div>
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Posts</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr>
        <td>{{ $user->id }}</td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->getRoleNames()->implode(", ") }}</td>
        <td>{{ $user->posts()->count() }}</td>
        <td><a href="{{route('user.edit', ['user' => $user->id])}}">Edit</a></td>
        <td>
          <form action="{{route('user.destroy', ['user' => $user->id])}}" method="post">
            @csrf
            @method('delete')
            <input type="submit" value="Delete">
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
  {{ $users->links('pagination.bootstrap') }}
@endsection