@extends('layouts.public')

@section('body_class', 'error')

@section('title', __('Forbidden'))

@section('content')
  @auth
  @if (auth()->user()->email_verified_at == null)
  <div class="verify_email">Please verify your email</div>
  @endif
  @endauth
  <section class="error">
    <div class="row">
      <div class="container">
        <h1><i class="fas fa-exclamation-triangle"></i>{{__('Forbidden')}}</h1>
      </div><!-- .container -->  
    </div><!-- .row -->  
  </section><!-- .error -->
@endsection