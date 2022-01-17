<div>
    <div class="list-group list-group-flush">
    @foreach ($links as $link)
        <a href="{{$link['route']}}" class="list-group-item list-group-item-action {{$link['class']}}">{{$link['title']}}</a><!-- .list-group-item -->
        {{--  --}}
    @endforeach
    </div><!-- .list-group -->
</div>