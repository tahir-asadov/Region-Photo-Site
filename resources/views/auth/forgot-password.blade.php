@extends('layouts.auth')

@section('content')
    <h1 class="text-center fs-3">Forgot Password</h1>
    <form action="/forgot-password" method="post">
      @csrf
      <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="">
      @error('email') <div class="text-danger" style="font-size: 14px;">{{$message}}</div> @enderror
      <div class="d-flex justify-content-center">
        <input type="submit" class="btn btn-primary mt-3" value="Send recovery email">
      </div>
    </form>
@endsection