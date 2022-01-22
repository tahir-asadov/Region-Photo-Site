
    <!-- Posts -->
    <section class="posts-section">
        @if(count($posts))
        <div class="row row-top">
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
        </div><!-- .row row-top -->
        <div class="row row-bottom">
            {{$posts->withQueryString()->links('pagination.bootstrap')}}
        </div><!-- .row row-bottom -->
        @else
        <div class="row">
            <div class="container">
                <h5 class="tc pt-100">Noting found</h5>
            </div><!-- .container -->
        </div><!-- .row -->
        @endif
    </section><!-- .posts-section -->