@extends('layouts.public')

@section('title', 'Region')

@section('content')

    <section class="title-section">
        <div class="row">
            <h4>Region: {{$region->title}}</h4>    
        </div><!-- .row -->
    </section><!-- .title-section -->

    <x-posts :posts="$posts"></x-posts>
@endsection