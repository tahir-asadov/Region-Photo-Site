@extends('layouts.admin')


@section('content')
  <h3 class="border-bottom pb-2 mb-3">Add new city</h3>
  <form action="{{route('city.store')}}" method="post">
    @csrf
    @method('post')
    <div class="mb-2">
      <label for="title" class="form-label font-weight-bold">Title</label>
      <input type="text" name="title" value="{{old('title')}}" id="title" class="form-control @error('title') is-invalid @enderror">
      @error('title')
        <div class="text-danger">{{$message}}</div>
      @enderror
    </div>
    <div class="mb-2">
      <label for="slug" class="form-label font-weight-bold">Slug</label>
      <input type="text" name="slug" value="{{old('slug')}}" id="slug" class="form-control @error('slug') is-invalid @enderror">
      @error('slug')
        <div class="text-danger">{{$message}}</div>
      @enderror
    </div>
    <div class="my-2 d-flex justify-content-end">
      <input type="submit" value="Add" class="btn btn-primary">
    </div>
  </form>
@endsection