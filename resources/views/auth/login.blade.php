@extends('layouts.auth')

@section('content')
<form action="/login" method="post">
  <h1 class="text-center">Login</h1>
  @csrf
  <label for="name" class="form-label">Email</label>
  <input type="email" class="form-control mb-2" name="email" id="email" placeholder="Email" value="">
  @error('email') <div class="text-danger" style="font-size: 14px;">{{$message}}</div> @enderror
  <label for="name" class="form-label">Password</label>
  <input type="password" class="form-control mb-2" name="password" id="password" placeholder="Password" value="">
  @error('password') <div class="text-danger" style="font-size: 14px;">{{$message}}</div> @enderror
  <label for="remember" class="form-label">
    <input type="checkbox" name="remember" id="remember">
    Remember
  </label>
  <div class="d-flex justify-content-center">
    <input type="submit" class="btn btn-primary mt-3" value="Login">
  </div>
</form>
<br>
<h5 class="text-center">Social Login</h5>
<div class="social-logins">
  <a class="btn btn-primary" href="/auth/facebook"><i class="fab fa-facebook-square"></i>Facebook</a>
  <a class="btn btn-danger" href="/auth/google"><i class="fab fa-google"></i>Google</a>
  <a class="btn btn-info" href="/auth/twitter"><i class="fab fa-twitter"></i>Twitter</a>
  <a class="btn btn-dark" href="/auth/github"><i class="fab fa-github"></i>Github</a>
</div><!-- .social-logons -->
<div class="d-flex justify-content-center p-2">
  <div>or</div>
</div>
<div class="d-flex justify-content-center">
  <div><a href="{{route('auth.register')}}">Register</a></div>
</div>

@endsection