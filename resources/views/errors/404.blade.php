@extends('layouts.public')

@section('body_class', 'error')

@section('title', __('Page Not Found'))

@section('content')
  <section class="error">
    <div class="row">
      <div class="container">
        <h1><i class="fas fa-exclamation-triangle"></i>{{__('Page Not Found')}}</h1>
      </div><!-- .container -->  
    </div><!-- .row -->  
  </section><!-- .error -->
@endsection