@extends('layouts.users')

@section('content')
    <h1>Resend verify email Form</h1>
    <form action="/email/verification-notification" method="post">
      @csrf
      <label for="name">Email</label>
      <input type="email" name="email" id="email" placeholder="Email" value="tahir-asadov@outlook.com">
      <input type="submit" value="Register">
    </form>
@endsection