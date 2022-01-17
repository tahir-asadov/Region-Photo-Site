<div class="tags">
    @foreach ($cities as $city)
    <a href="{{route('public.city', ['city' => $city->slug])}}">{{$city->title}}</a>
    @endforeach
</div><!-- .tags -->