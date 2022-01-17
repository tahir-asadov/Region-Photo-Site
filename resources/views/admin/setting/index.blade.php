@extends('layouts.admin')

@section('title', 'Settings')

@section('sidebar')@endsection

@section('content')
  <div class="mb-2 d-flex justify-content-end">
    <a href="{{route('setting.create')}}" class="btn btn-success">New setting</a>
  </div>
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Key</th>
        <th>Value</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($settings as $setting)
      <tr>
        <td>{{ $setting->id }}</td>
        <td>{{ $setting->key }}</td>
        <td>{{ $setting->value }}</td>
        <td><a href="{{route('setting.edit', ['setting' => $setting->id])}}">Edit</a></td>
        <td>
          <form action="{{route('setting.destroy', ['setting' => $setting->id])}}" method="post">
            @csrf
            @method('delete')
            <input type="submit" value="Delete">
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
@endsection