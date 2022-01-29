@extends('layouts.auth')

@section('content')
<form action="/resend-email-verification" method="post">
  <h1 class="text-center">Verify your email</h1>
  @csrf
  <div class="d-flex justify-content-center">
    <input type="submit" class="btn btn-primary mt-3" value="Send verification email">
  </div>
</form>
<br>
@endsection