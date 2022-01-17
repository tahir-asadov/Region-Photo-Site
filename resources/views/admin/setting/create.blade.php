@extends('layouts.admin')

@section('title', 'Settings')

@section('content')
  <h3 class="border-bottom pb-2 mb-3">Add new setting</h3>
  <form action="{{route('setting.store')}}" method="post">
    @csrf
    @method('post')
    <div class="mb-2">
      <label for="key" class="form-label font-weight-bold">Key</label>
      <input type="text" name="key" value="{{old('key')}}" id="key" class="form-control @error('key') is-invalid @enderror">
      @error('key')
        <div class="text-danger">{{$message}}</div>
      @enderror
    </div>
    <div class="mb-2">
      <label for="value" class="form-label font-weight-bold">Value</label>
      <input type="text" name="value" value="{{old('value')}}" id="value" class="form-control @error('value') is-invalid @enderror">
      @error('value')
        <div class="text-danger">{{$message}}</div>
      @enderror
    </div>
   
    <div class="my-2 d-flex justify-content-end">
      <input type="submit" value="Add" class="btn btn-primary">
    </div>
  </form>
@endsection