

@extends('layouts.users')

@section('content')
    <h1>Reset Password</h1>
    <form action="/reset-password" method="post">
      @csrf
      <label for="name">Email</label>
      <input type="email" name="email" id="email" placeholder="Email" value="tahir-asadov@outlook.com">
      <label for="name">Password</label>
      <input type="password" name="password" id="password" placeholder="Password" value="tahir-asadov@outlook.com">
      <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Password confirmation"  value="tahir-asadov@outlook.com">
      <input type="text" name="token" value="{{request()->route('token')}}">
      <input type="submit" value="Register">
    </form>
@endsection