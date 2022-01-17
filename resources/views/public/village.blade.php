@extends('layouts.public')

@section('title', 'Village')

@section('content')

    <section class="title-section">
        <div class="row">
            <h4>Village: {{$village->title}}</h4>    
        </div><!-- .row -->
    </section><!-- .title-section -->

    <x-posts :posts="$posts"></x-posts>
@endsection