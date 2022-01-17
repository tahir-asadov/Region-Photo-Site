@extends('layouts.public')

@section('title', 'City')

@section('content')

    <section class="title-section">
        <div class="row">
            <h4>City: {{$city->title}}</h4>    
        </div><!-- .row -->
    </section><!-- .title-section -->

    <x-posts :posts="$posts"></x-posts>

    @endsection