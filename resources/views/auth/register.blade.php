@extends('layouts.auth')

@section('content')
    <h1 class="text-center">Register</h1>
    <form action="/register" method="post">
      @csrf
      <label for="name" class="form-label">Full name</label>
      <input type="text" class="form-control" name="name" id="name" placeholder="Full name" value="">
      @error('name') <div class="text-danger" style="font-size: 14px;">{{$message}}</div> @enderror
      <label for="name" class="form-label">Email</label>
      <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="">
      @error('email') <div class="text-danger" style="font-size: 14px;">{{$message}}</div> @enderror
      <label for="name" class="form-label">Password</label>
      <input type="password" class="form-control" name="password" id="password" placeholder="Password" value="">
      @error('password') <div class="text-danger" style="font-size: 14px;">{{$message}}</div> @enderror
      <label for="name" class="form-label">Password confirmation</label>
      <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" placeholder="Password confirmation"  value="">
      <div class="d-flex justify-content-center">
        <input type="submit" class="btn btn-primary mt-3" value="Register">
      </div>
      <div class="d-flex justify-content-center p-2">
        <div>or</div>
      </div>
      <div class="d-flex justify-content-center">
        <div><a href="{{route('auth.login')}}">Login</a></div>
      </div>
    </form>
@endsection