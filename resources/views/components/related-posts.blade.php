
  <!-- Related posts -->
  <section class="related-section">
    <div class="row row-top">
      <div class="container">
        <h3>Related posts</h3>
      </div><!-- .container -->
    </div><!-- .row row-top -->
    <div class="row row-bottom">
      <div class="container">
        @foreach ($posts as $post)
        <div>
            <a href="{{route('public.post', ['slug' => $post->url(), 'post' => $post->id])}}">
                <img loading="lazy" src="/storage/post_images/{{$post->thumbnail()}}" alt="">
            </a>
            <div class="info">
                <div class="top">
                    @if ($post->city)
                    <a href="{{$post->city->url()}}">{{$post->city->title}}</a>
                    @endif
                    <span>{{count($post->images)}} photos</span>
                </div><!-- .top -->
                <div class="bottom">
                    <a href="{{$post->user->url()}}">{{$post->user->name}}</a>
                    <span>{{$post->user->created_at->diffForHumans()}}</span>
                </div><!-- .bottom -->
            </div><!-- .info -->
        </div>
        @endforeach
      </div><!-- .container -->
    </div><!-- .row row-bottom -->
  </section><!-- .related-section -->