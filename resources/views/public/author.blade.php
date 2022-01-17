@extends('layouts.public')

@section('title', 'Author')

@section('content')

<section class="title-section">
    <div class="row">
        <h4>Author: {{$author->name}}</h4>    
    </div><!-- .row -->
</section><!-- .title-section -->

    <x-posts :posts="$posts"></x-posts>
@endsection