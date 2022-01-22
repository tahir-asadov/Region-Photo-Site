@extends('layouts.author')

@section('content')
<div class="navigation-container">
  <a href="javascript:history.back()"><i class="fas fa-arrow-left"></i> Back</a>  
</div><!-- .navigation-container -->
<form action="{{route('author.update-profile')}}" class="form-group p-2" method="post" enctype="multipart/form-data">
    @csrf
    @method('post')
    <label for="name" class="form-label">Full name</label>
    <input type="text" class="form-control mb-2" placeholder="Full name" value="{{auth()->user()->name}}" id="name" name="name">
    <label for="current_password" class="form-label">Current Password</label>
    <input type="password" class="form-control mb-2" id="current_password" name="current_password">
    <label for="new_password" class="form-label">New Password</label>
    <input type="password" class="form-control mb-2" id="new_password" name="new_password">
    <label for="new_password_confirmation" class="form-label">New Password Confirm</label>
    <input type="password" class="form-control mb-2" id="new_password_confirmation" name="new_password_confirmation">
    <input type="file" name="picture">
    <input type="submit" class="btn btn-primary mt-3" value="Update">
</form>
@endsection