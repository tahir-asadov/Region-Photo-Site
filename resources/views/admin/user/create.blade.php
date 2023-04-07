@extends('layouts.admin')
@section('title', 'Add new user')
@section('content')
  <form action="{{route('user.store')}}" method="post">
    @csrf
    @method('post')
    <div class="mb-2">
      <label for="name" class="form-label font-weight-bold">Name</label>
      <input type="text" name="name" value="{{old('name')}}" id="name" class="form-control @error('name') is-invalid @enderror">
      @error('name')
        <div class="text-danger">{{$message}}</div>
      @enderror
    </div>
    <div class="mb-2">
      <label for="email" class="form-label font-weight-bold">E-mail</label>
      <input type="email" name="email" value="{{old('email')}}" id="email" class="form-control @error('email') is-invalid @enderror">
      @error('email')
        <div class="text-danger">{{$message}}</div>
      @enderror
    </div>
    <div class="mb-2">
      <label for="roles" class="form-label font-weight-bold">Roles</label>
      <select name="roles[]" multiple class="form-select @error('roles') is-invalid @enderror" id="roles">
        @foreach ($roles as $role)
        @if (old('role') == $role->id)
        <option selected value="{{ $role->id }}">{{ $role->name }}</option>
        @else
        <option value="{{ $role->id }}">{{ $role->name }}</option>
        @endif
        @endforeach
      </select>
      @error('role')
        <div class="text-danger">{{$message}}</div>
      @enderror
    </div>
    <div class="mb-2">
      <label for="password" class="form-label font-weight-bold">Password</label>
      <input type="password" name="password" value="" id="password" class="form-control @error('password') is-invalid @enderror">
      @error('password')
        <div class="text-danger">{{$message}}</div>
      @enderror
    </div>
    <div class="mb-2">
      <label for="password_confirmation" class="form-label font-weight-bold">Password confirm</label>
      <input type="password" name="password_confirmation" value="" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror">
      @error('password_confirmation')
        <div class="text-danger">{{$message}}</div>
      @enderror
    </div>
    <div class="my-2 d-flex justify-content-end">
      <input type="submit" value="Add" class="btn btn-primary">
    </div>
  </form>
@endsection