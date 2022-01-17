@extends('layouts.public')

@section('body_class', 'home')

@section('title', 'Home')

@section('content')
    @if (request('s') != '')
    <section class="title-section">
        <div class="row">
            <h4>Search result for: {{request('s')}}</h4>    
        </div><!-- .row -->
    </section><!-- .title-section -->
    @endif

    <x-posts :posts="$posts"></x-posts>
@endsection