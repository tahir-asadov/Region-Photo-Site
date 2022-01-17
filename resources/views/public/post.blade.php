@extends('layouts.public')

@section('body_class', 'post')

@section('content')
  <section class="post-section">
    <div class="row row-top">
      <div class="container">
          <h1>{{$post->title}}</h1>
      </div><!-- .container -->
    </div><!-- .row row-top -->
    <div class="row row-bottom">
      <div class="container">
        <div class="left">
          <div class="info">
              <div><b>Date: </b>{{$post->created_at->diffForHumans()}}</div>
              <div><b>Author: </b><a href="{{$post->user->url()}}">{{$post->user->name}}</a></div>
              <div><b>Region: </b><a href="{{$post->region->url()}}">{{$post->region->title}}</a></div>
              <div><b>City: </b><a href="{{$post->city->url()}}">{{$post->city->title}}</a></div>
              <div><b>Village: </b><a href="{{$post->village ? $post->village->url() : '#'}}">{{$post->village ? $post->village->title : '-'}}</a></div>
          </div><!-- .info -->
          <div class="share">
            <h3>Share post on:</h3>
            <div class="social">
              <a href="{{route('public.post', ['slug' => $post->url(), 'post' => $post->id])}}" class="facebook"><i class="fab fa-facebook-f"></i></a>
              <a href="{{route('public.post', ['slug' => $post->url(), 'post' => $post->id])}}" class="twitter"><i class="fab fa-twitter"></i></a>
              <a href="{{route('public.post', ['slug' => $post->url(), 'post' => $post->id])}}" class="pinterest"><i class="fab fa-pinterest-p"></i></a>
            </div><!-- .social -->
          </div><!-- .share -->
        </div><!-- .left -->
        <div class="right single-post-gallery">
          <div class="thumbs">
            @foreach ($post->images as $image)
            <div>
              <img original="/storage/post_images/{{$image->path}}" src="/storage/post_images/{{$image->thumbnail}}" alt="">
              <a href="/storage/post_images/{{$image->path}}" download><i class="fas fa-download"></i></a>
            </div>
            @endforeach
          </div><!-- .thumbs -->
          <div class="main">
            
            @foreach ($post->images as $image)
              @if ($loop->first)
                <img src="/storage/post_images/{{$image->path}}" alt="">
                @break
              @endif
            @endforeach
          </div><!-- .main -->
        </div><!-- .right single-post-gallery -->
      </div><!-- .container -->
    </div><!-- .row row-bottom -->
  </section><!-- .post-section -->


  <x-authors-posts :userid="$post->user->id"></x-authors-posts>
  <br>
  <br>
  <x-related-posts :region="$post->region->slug"></x-related-posts>

@endsection

